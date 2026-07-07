<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        $query = DB::table('feedback')
            ->orderBy('feedback.created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw('EXISTS (SELECT 1 FROM auth.users WHERE auth.users.id = feedback.user_id AND (auth.users.email ILIKE ?))', ["%$search%"])
                    ->orWhereRaw('EXISTS (SELECT 1 FROM profiles WHERE profiles.id = feedback.user_id AND (profiles.matrik ILIKE ?))', ["%$search%"]);
            });
        }

        if ($request->filled('rating')) {
            $query->where('feedback.keseluruhan', (int) $request->rating);
        }

        $feedbacks = $query->select(
            'feedback.id',
            'feedback.user_id',
            'feedback.keseluruhan',
            'feedback.komen',
            'feedback.cadangan',
            'feedback.created_at'
        )->paginate(8)->appends($request->query());

        $userIds = $feedbacks->pluck('user_id')->unique()->toArray();

        $users = collect();
        $profiles = collect();
        if (! empty($userIds)) {
            $users = DB::table('auth.users')
                ->whereIn('id', $userIds)
                ->get(['id', 'email', 'raw_user_meta_data'])
                ->keyBy('id');

            $profiles = DB::table('profiles')
                ->whereIn('id', $userIds)
                ->get(['id', 'matrik'])
                ->keyBy('id');
        }

        foreach ($feedbacks as $f) {
            $user = $users->get($f->user_id);
            $profile = $profiles->get($f->user_id);
            if ($user) {
                $meta = json_decode($user->raw_user_meta_data ?? '{}');
                $f->nama = $meta->name ?? $user->email;
            } else {
                $f->nama = '—';
            }
            $f->matrik = $profile->matrik ?? '—';
        }

        return view('feedback-list', compact('feedbacks'));
    }

    public function show(string $id): View
    {
        $feedback = DB::table('feedback')->where('id', $id)->first();

        if (! $feedback) {
            abort(404);
        }

        $user = DB::table('auth.users')->where('id', $feedback->user_id)->first(['id', 'email', 'raw_user_meta_data']);
        $profile = DB::table('profiles')->where('id', $feedback->user_id)->first();

        return view('feedback-detail', compact('feedback', 'user', 'profile'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AllBookingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Booking::orderBy('created_at', 'desc');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $statusMap = [
                'disahkan' => 'approved',
                'menunggu' => 'pending',
                'dibatalkan' => 'rejected',
            ];
            $query->where('status', $statusMap[$request->status] ?? $request->status);
        }

        if ($request->filled('dapur')) {
            $query->where('kitchen_name', $request->dapur);
        }

        $bookings = $query->paginate(8)->appends($request->query());

        $userIds = $bookings->pluck('user_id')->unique()->toArray();

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

        $bookings->getCollection()->transform(function ($b) use ($users, $profiles) {
            $user = $users->get($b->user_id);
            $profile = $profiles->get($b->user_id);
            if ($user) {
                $meta = json_decode($user->raw_user_meta_data ?? '{}');
                $b->nama = $meta->name ?? explode('@', $user->email)[0];
                $b->emel = $user->email;
                $b->matrik = $profile->matrik ?? '—';
            } else {
                $b->nama = '—';
                $b->emel = '—';
                $b->matrik = '—';
            }

            return $b;
        });

        $dapurList = Booking::distinct()->orderBy('kitchen_name')->pluck('kitchen_name');

        return view('all-booking', compact('bookings', 'dapurList'));
    }
}

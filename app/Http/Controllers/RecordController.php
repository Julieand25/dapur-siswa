<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RecordController extends Controller
{
    public function index(Request $request): View
    {
        $query = DB::table('reviews')
            ->leftJoin('bookings', 'reviews.booking_id', '=', 'bookings.id')
            ->orderBy('reviews.created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw('EXISTS (SELECT 1 FROM auth.users WHERE auth.users.id = reviews.user_id AND (auth.users.email ILIKE ?))', ["%$search%"])
                    ->orWhereRaw('EXISTS (SELECT 1 FROM profiles WHERE profiles.id = reviews.user_id AND (profiles.matrik ILIKE ?))', ["%$search%"]);
            });
        }

        if ($request->filled('lokasi')) {
            $query->where('reviews.location_code', $request->lokasi);
        }

        if ($request->filled('dapur')) {
            $query->where('reviews.kitchen_name', $request->dapur);
        }

        $reviews = $query->select(
            'reviews.id',
            'reviews.user_id',
            'reviews.kitchen_name',
            'reviews.location_code',
            'reviews.date',
            'reviews.created_at',
            'bookings.bilangan_hidangan'
        )->paginate(8)->appends($request->query());

        $userIds = $reviews->pluck('user_id')->unique()->toArray();

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

        foreach ($reviews as $review) {
            $user = $users->get($review->user_id);
            $profile = $profiles->get($review->user_id);
            if ($user) {
                $meta = json_decode($user->raw_user_meta_data ?? '{}');
                $review->nama = $meta->name ?? $user->email;
            } else {
                $review->nama = '—';
            }
            $review->emel = $user->email ?? '—';
            $review->matrik = $profile->matrik ?? '—';
        }

        $lokasiList = DB::table('reviews')->distinct()->orderBy('location_code')->pluck('location_code');
        $dapurList = DB::table('reviews')->distinct()->orderBy('kitchen_name')->pluck('kitchen_name');

        return view('record-list', compact('reviews', 'lokasiList', 'dapurList'));
    }

    public function show(string $id): View
    {
        $review = DB::table('reviews')->where('id', $id)->first();

        if (! $review) {
            abort(404);
        }

        $user = DB::table('auth.users')->where('id', $review->user_id)->first(['id', 'email', 'raw_user_meta_data']);
        $profile = DB::table('profiles')->where('id', $review->user_id)->first();

        $bilanganHidangan = '—';
        if ($review->booking_id) {
            $booking = DB::table('bookings')->where('id', $review->booking_id)->first(['bilangan_hidangan']);
            if ($booking) {
                $bilanganHidangan = $booking->bilangan_hidangan;
            }
        }

        $equipment = [];
        $rawEquipment = json_decode($review->equipment ?? '{}', true);
        if (is_array($rawEquipment)) {
            foreach ($rawEquipment as $name => $used) {
                if ($used) {
                    $equipment[] = $name;
                }
            }
        }

        $allBahanUnits = DB::table('bahan')
            ->select('nama', 'unit')
            ->distinct()
            ->get()
            ->keyBy('nama')
            ->map(function ($b) {
                return $b->unit;
            });

        $ingredients = [];
        $rawIngredients = json_decode($review->ingredients ?? '{}', true);
        if (is_array($rawIngredients)) {
            foreach ($rawIngredients as $name => $qty) {
                $ingredients[] = [
                    'nama' => $name,
                    'kuantiti' => $qty,
                    'unit' => $allBahanUnits[$name] ?? '—',
                ];
            }
        }

        return view('record-detail', compact(
            'review', 'user', 'profile',
            'bilanganHidangan', 'equipment', 'ingredients'
        ));
    }
}

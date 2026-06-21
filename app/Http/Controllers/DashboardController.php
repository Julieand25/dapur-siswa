<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
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

        $bookings = $query->get();

        $todayCount = Booking::whereDate('date', today())->count();
        $pendingCount = Booking::where('status', 'pending')->count();

        $userIds = $bookings->pluck('user_id')->unique()->toArray();

        $users = collect();
        if (! empty($userIds)) {
            $users = DB::table('auth.users')
                ->whereIn('id', $userIds)
                ->get(['id', 'email', 'raw_user_meta_data'])
                ->keyBy('id');
        }

        foreach ($bookings as $booking) {
            $user = $users->get($booking->user_id);
            if ($user) {
                $meta = json_decode($user->raw_user_meta_data ?? '{}');
                $booking->nama = $meta->name ?? explode('@', $user->email)[0];
                $booking->emel = $user->email;
                $booking->matrik = $meta->matrik ?? '—';
            } else {
                $booking->nama = '—';
                $booking->emel = '—';
                $booking->matrik = '—';
            }
        }

        if ($request->filled('search')) {
            $search = mb_strtolower($request->search);
            $bookings = $bookings->filter(function ($b) use ($search) {
                return str_contains(mb_strtolower($b->nama), $search)
                    || str_contains(mb_strtolower($b->emel), $search)
                    || str_contains(mb_strtolower($b->matrik), $search)
                    || str_contains(mb_strtolower($b->location_code), $search)
                    || str_contains(mb_strtolower($b->kitchen_name), $search);
            })->values();
        }

        $dapurList = Booking::distinct()->orderBy('kitchen_name')->pluck('kitchen_name');

        return view('dashboard', compact('bookings', 'todayCount', 'pendingCount', 'dapurList'));
    }

    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        DB::table('bookings')->where('id', $booking->id)->update([
            'status' => $request->status,
        ]);

        $label = $request->status === 'approved' ? 'diterima' : 'ditolak';

        return back()->with('success', 'Tempahan berjaya '.$label.'.');
    }
}

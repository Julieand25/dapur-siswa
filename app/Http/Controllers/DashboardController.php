<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();

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

        return view('dashboard', compact('bookings', 'todayCount', 'pendingCount'));
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

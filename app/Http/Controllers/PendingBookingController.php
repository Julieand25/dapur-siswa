<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PendingBookingController extends Controller
{
    public function index(): View
    {
        $pendingBookings = Booking::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $userIds = $pendingBookings->pluck('user_id')->unique()->toArray();

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

        foreach ($pendingBookings as $booking) {
            $user = $users->get($booking->user_id);
            $profile = $profiles->get($booking->user_id);
            if ($user) {
                $meta = json_decode($user->raw_user_meta_data ?? '{}');
                $booking->nama = $meta->name ?? explode('@', $user->email)[0];
                $booking->emel = $user->email;
                $booking->matrik = $profile->matrik ?? '—';
            } else {
                $booking->nama = '—';
                $booking->emel = '—';
                $booking->matrik = '—';
            }
        }

        $bookingsJson = $pendingBookings->map(function ($b) {
            $tz = 'Asia/Kuala_Lumpur';

            return [
                'id' => $b->id,
                'nama' => $b->nama,
                'emel' => $b->emel,
                'matrik' => $b->matrik,
                'location_code' => $b->location_code,
                'kitchen_name' => $b->kitchen_name,
                'date' => Carbon::parse($b->date)->format('d/m/Y'),
                'date_full' => Carbon::parse($b->date)->locale('ms')->isoFormat('D MMM YYYY (dddd)'),
                'start_time' => $b->start_time,
                'end_time' => $b->end_time,
                'status' => $b->status,
                'bilangan_hidangan' => $b->bilangan_hidangan ?? 1,
                'created_at' => Carbon::parse($b->created_at)->setTimezone($tz)->locale('ms')->isoFormat('D MMM YYYY, h:mm A'),
                'statusUrl' => route('bookings.status', $b->id),
            ];
        })->values();

        return view('pending-booking', compact('pendingBookings', 'bookingsJson'));
    }
}

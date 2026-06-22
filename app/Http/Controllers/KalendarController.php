<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KalendarController extends Controller
{
    public function index(Request $request): View
    {
        $month = (int) $request->input('month', now()->month);
        $year = (int) $request->input('year', now()->year);

        $bookings = Booking::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        $userIds = $bookings->pluck('user_id')->unique()->toArray();

        $users = collect();
        if (! empty($userIds)) {
            $users = DB::table('auth.users')
                ->whereIn('id', $userIds)
                ->get(['id', 'email', 'raw_user_meta_data'])
                ->keyBy('id');
        }

        $bookingsByDay = [];

        foreach ($bookings as $b) {
            $day = (int) Carbon::parse($b->date)->format('j');

            $user = $users->get($b->user_id);

            $bookingData = [
                'id' => $b->id,
                'nama' => '—',
                'emel' => '—',
                'matrik' => '—',
                'kitchen_name' => $b->kitchen_name,
                'location_code' => $b->location_code,
                'date_full' => Carbon::parse($b->date)->locale('ms')->isoFormat('D MMM YYYY (dddd)'),
                'start_time' => $b->start_time,
                'end_time' => $b->end_time,
                'status' => $b->status,
                'bilangan_hidangan' => $b->bilangan_hidangan ?? 1,
                'statusUrl' => route('bookings.status', $b->id),
            ];

            if ($user) {
                $meta = json_decode($user->raw_user_meta_data ?? '{}');
                $bookingData['nama'] = $meta->name ?? explode('@', $user->email)[0];
                $bookingData['emel'] = $user->email;
                $bookingData['matrik'] = $meta->matrik ?? '—';
            }

            $bookingsByDay[$day][] = $bookingData;
        }

        $dapurList = Booking::distinct()->orderBy('kitchen_name')->pluck('kitchen_name');

        return view('kalendar', [
            'bookingsByDay' => $bookingsByDay,
            'month' => $month,
            'year' => $year,
            'dapurList' => $dapurList,
        ]);
    }
}

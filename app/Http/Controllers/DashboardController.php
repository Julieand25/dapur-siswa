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

        foreach ($bookings as $booking) {
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

        $lowStockItems = DB::table('bahan')
            ->join('dapur', 'bahan.dapur_id', '=', 'dapur.id')
            ->whereColumn('bahan.kuantiti', '<=', 'bahan.low_stock_threshold')
            ->select(
                'bahan.nama',
                'bahan.kuantiti',
                'bahan.unit',
                'bahan.low_stock_threshold',
                'dapur.nama_dapur',
                'dapur.lokasi'
            )
            ->orderBy('bahan.kuantiti')
            ->get();

        $lowStockCount = $lowStockItems->count();

        return view('dashboard', compact(
            'bookings', 'todayCount', 'pendingCount', 'dapurList', 'lowStockItems', 'lowStockCount'
        ));
    }

    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected'],
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $data = [
            'status' => $request->status,
            'processed_by' => auth()->id(),
        ];

        if ($request->status === 'rejected' && $request->filled('rejection_reason')) {
            $data['rejection_reason'] = $request->rejection_reason;
        }

        DB::table('bookings')->where('id', $booking->id)->update($data);

        if ($request->status === 'approved') {
            DB::table('bookings')
                ->where('date', $booking->date)
                ->where('location_code', $booking->location_code)
                ->where('kitchen_name', $booking->kitchen_name)
                ->where('status', 'pending')
                ->where('id', '!=', $booking->id)
                ->where('start_time', '<', $booking->end_time)
                ->where('end_time', '>', $booking->start_time)
                ->update([
                    'status' => 'rejected',
                    'processed_by' => auth()->id(),
                    'rejection_reason' => 'Slot telah diambil oleh tempahan lain.',
                ]);
        }

        $label = $request->status === 'approved' ? 'diterima' : 'ditolak';

        return back()->with('success', 'Tempahan berjaya '.$label.'.');
    }
}

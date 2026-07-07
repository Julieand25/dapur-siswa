<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserListController extends Controller
{
    public function index(Request $request): View
    {
        $query = DB::table('auth.staff')
            ->leftJoin('profiles', 'auth.staff.id', '=', DB::raw('profiles.id::uuid'))
            ->orderBy('auth.staff.created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('profiles.name', 'ilike', '%'.$search.'%')
                    ->orWhere('profiles.matrik', 'ilike', '%'.$search.'%')
                    ->orWhere('auth.staff.email', 'ilike', '%'.$search.'%');
            });
        }

        $users = $query->paginate(8, [
            'auth.staff.id',
            'auth.staff.email',
            'auth.staff.created_at',
            'profiles.name',
            'profiles.matrik',
            'profiles.faculty',
            'profiles.program',
            'profiles.phone',
        ])->appends($request->query());

        return view('user-list', compact('users'));
    }
}

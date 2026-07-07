<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserListController extends Controller
{
    public function index(Request $request): View
    {
        $query = DB::table('auth.users')
            ->leftJoin('profiles', 'auth.users.id', '=', DB::raw('profiles.id::uuid'))
            ->orderBy('auth.users.created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where(DB::raw("auth.users.raw_user_meta_data->>'name'"), 'ilike', '%'.$search.'%')
                    ->orWhere('profiles.matrik', 'ilike', '%'.$search.'%')
                    ->orWhere('auth.users.email', 'ilike', '%'.$search.'%');
            });
        }

        $users = $query->paginate(8, [
            'auth.users.id',
            'auth.users.email',
            'auth.users.created_at',
            DB::raw("auth.users.raw_user_meta_data->>'name' as name"),
            'profiles.matrik',
            'profiles.faculty',
            'profiles.program',
            'profiles.phone',
        ])->appends($request->query());

        return view('user-list', compact('users'));
    }
}

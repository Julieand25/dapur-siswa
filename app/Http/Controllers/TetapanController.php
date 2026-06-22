<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TetapanController extends Controller
{
    public function index(): View
    {
        return view('settings', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user->fill($request->only('name', 'phone', 'position'));

        if ($request->boolean('remove_avatar')) {
            $user->avatar_url = null;
        } elseif ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'user-'.$user->id.'-'.time().'.'.$file->getClientOriginalExtension();
            $mimeType = $file->getMimeType();
            $contents = file_get_contents($file->getRealPath());

            $storageUrl = config('services.supabase.storage_url');
            $bucket = config('services.supabase.bucket');
            $key = config('services.supabase.service_role_key');

            $response = Http::withToken($key)
                ->withHeaders(['Content-Type' => $mimeType])
                ->withBody($contents, $mimeType)
                ->post($storageUrl.'/object/'.$bucket.'/'.$filename);

            if ($response->successful()) {
                $user->avatar_url = $storageUrl.'/object/public/'.$bucket.'/'.$filename;
            } else {
                return back()->with('error', 'Gagal memuat naik gambar. Sila cuba lagi.');
            }
        }

        $user->save();

        return back()->with('success', 'Profil berjaya dikemaskini.');
    }
}

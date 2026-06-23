<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(10);

        return view('pemberitahuan-index', compact('announcements'));
    }

    public function create(): View
    {
        return view('pemberitahuan-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        Announcement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('pemberitahuan.index')->with('success', 'Pemberitahuan berjaya dicipta.');
    }

    public function edit(Announcement $announcement): View
    {
        return view('pemberitahuan-edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $announcement->update($validated);

        return redirect()->route('pemberitahuan.index')->with('success', 'Pemberitahuan berjaya dikemaskini.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return redirect()->route('pemberitahuan.index')->with('success', 'Pemberitahuan berjaya dipadam.');
    }
}

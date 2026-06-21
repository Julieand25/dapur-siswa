<?php

namespace App\Http\Controllers;

use App\Models\Dapur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DapurController extends Controller
{
    public function index(Request $request): View
    {
        $dapurs = Dapur::query()
            ->filter([
                'search' => $request->query('search'),
                'lokasi' => $request->query('lokasi'),
                'status' => $request->query('status'),
            ])
            ->orderBy('lokasi')
            ->orderBy('nama_dapur')
            ->paginate(8)
            ->appends($request->query());

        return view('dapur-list', compact('dapurs'));
    }

    public function create(): View
    {
        return view('create-dapur');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'lokasi' => ['required', 'string', 'in:KHAR,KUO,KAHS,KAB,KZ'],
            'nama_dapur' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:tersedia,tidak-tersedia'],
            'max_orang' => ['required', 'integer', 'min:1'],
        ]);

        Dapur::create($validated);

        return redirect()->route('dapur.index')->with('success', 'Dapur berjaya ditambah.');
    }

    public function edit(Dapur $dapur): View
    {
        return view('edit-dapur', compact('dapur'));
    }

    public function update(Request $request, Dapur $dapur): RedirectResponse
    {
        $validated = $request->validate([
            'lokasi' => ['required', 'string', 'in:KHAR,KUO,KAHS,KAB,KZ'],
            'nama_dapur' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:tersedia,tidak-tersedia'],
            'max_orang' => ['required', 'integer', 'min:1'],
        ]);

        $dapur->update($validated);

        return redirect()->route('dapur.index')->with('success', 'Dapur berjaya dikemaskini.');
    }

    public function destroy(Dapur $dapur): RedirectResponse
    {
        $dapur->delete();

        return redirect()->route('dapur.index')->with('success', 'Dapur berjaya dipadam.');
    }
}

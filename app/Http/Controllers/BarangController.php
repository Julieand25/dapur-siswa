<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Dapur;
use App\Models\Peralatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
    public function index(Dapur $dapur): View
    {
        $peralatans = $dapur->peralatans()->orderBy('nama')->get();
        $bahans = $dapur->bahans()->orderBy('nama')->get();

        $lowBahanCount = $bahans->filter(fn($b) => $b->kuantiti <= $b->low_stock_threshold)->count();

        return view('manage-barang', compact('dapur', 'peralatans', 'bahans', 'lowBahanCount'));
    }

    public function storePeralatan(Request $request, Dapur $dapur): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kuantiti' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:Tersedia,Rosak,Diselenggara'],
        ]);

        $dapur->peralatans()->create($validated);

        return back()->with('success', 'Peralatan berjaya ditambah.');
    }

    public function updatePeralatan(Request $request, Dapur $dapur, Peralatan $peralatan): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kuantiti' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:Tersedia,Rosak,Diselenggara'],
        ]);

        $peralatan->update($validated);

        return back()->with('success', 'Peralatan berjaya dikemaskini.');
    }

    public function destroyPeralatan(Dapur $dapur, Peralatan $peralatan): RedirectResponse
    {
        $peralatan->delete();

        return back()->with('success', 'Peralatan berjaya dipadam.');
    }

    public function storeBahan(Request $request, Dapur $dapur): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kuantiti' => ['required', 'integer', 'min:1'],
            'unit' => ['required', 'string', 'max:50'],
        ]);

        $dapur->bahans()->create($validated);

        return back()->with('success', 'Bahan berjaya ditambah.');
    }

    public function updateBahan(Request $request, Dapur $dapur, Bahan $bahan): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kuantiti' => ['required', 'integer', 'min:1'],
            'unit' => ['required', 'string', 'max:50'],
        ]);

        $bahan->update($validated);

        return back()->with('success', 'Bahan berjaya dikemaskini.');
    }

    public function destroyBahan(Dapur $dapur, Bahan $bahan): RedirectResponse
    {
        $bahan->delete();

        return back()->with('success', 'Bahan berjaya dipadam.');
    }
}

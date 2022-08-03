<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('pages.unit.index', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_unit' => 'required',
            'price_unit' => 'required',
        ]);

        Unit::create([
            'name_unit' => $request->name_unit,
            'price_unit' => $request->price_unit,
        ]);

        return redirect()->route('unit.index')->with('success', 'Unit berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_unit' => 'required',
            'price_unit' => 'required',
        ]);

        $unit = Unit::find($id);
        $unit->update([
            'name_unit' => $request->name_unit,
            'price_unit' => $request->price_unit,
        ]);

        return redirect()->route('unit.index')->with('success', 'Unit berhasil diubah');
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        return redirect()->route('unit.index')->with('success', 'Unit berhasil dihapus');
    }
}

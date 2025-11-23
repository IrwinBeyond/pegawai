<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::orderBy('id', 'desc')
                             ->paginate(10);
        $departments = Department::all();
        return view('admin.positions.index', compact('positions', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Position::create($request->only(['nama_jabatan', 'gaji_pokok']));

        return redirect()->route('admin.positions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $position = Position::findOrFail($id);
        return view('admin.positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $position = Position::findOrFail($id);
        return view('admin.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $position = Position::findOrFail($id);
        $position->update($request->only(['nama_jabatan', 'gaji_pokok']));

        return redirect()->route('admin.positions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('admin.positions.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(5);
        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with('position')->get();
        return view('salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ]);

        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $gajiPokok = $employee->position->gaji_pokok ?? 0;
        $gajiTotal = $gajiPokok + $request->tunjangan - $request->potongan;

        Salary::create([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $request->tunjangan,
            'potongan' => $request->potongan,
            'total_gaji' => $gajiTotal,
        ]);

        return redirect()->route('salaries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salary = Salary::findOrFail($id);
        $employees = Employee::with('position')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
        ]);

        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $gajiPokok = $employee->position->gaji_pokok ?? 0;
        $gajiTotal = $gajiPokok + $request->tunjangan - $request->potongan;

        $salary = Salary::findOrFail($id);
        $salary->update([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $request->tunjangan,
            'potongan' => $request->potongan,
            'total_gaji' => $gajiTotal,
        ]);

        return redirect()->route('salaries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return redirect()->route('salaries.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');

        $employees = Employee::with(['department', 'position'])
            ->when($q, function ($query, $q) {
                $query->where(function($q2) use ($q) {
                    $q2->where('nama_lengkap', 'like', '%' . $q . '%')
                    ->orWhereHas('department', function($q3) use ($q) {
                            $q3->where('nama_departemen', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('position', function($q4) use ($q) {
                            $q4->where('nama_jabatan', 'like', '%' . $q . '%');
                    });
                });
            })
            ->latest()
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.employees.index', compact('employees', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();

        return view('admin.employees.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'status' => 'required|string|max:50',
        ]);

        Employee::create($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'departemen_id',
            'jabatan_id',
            'status'
        ]));

        return redirect()->route('admin.employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with(['department', 'position'])->findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();

        return view('admin.employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
            'status' => 'required|string|max:50',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'departemen_id',
            'jabatan_id',
            'status'
        ]));

        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::with('user')->findOrFail($id);

        if ($employee->user) {
            $employee->user->delete();
        }

        $employee->delete();

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Pegawai dan akun login terkait berhasil dihapus.');
    }

    public function createUser(Employee $employee)
    {
        if ($employee->user) {
            return redirect()
                ->route('admin.employees.show', $employee->id)
                ->with('error', 'Pegawai ini sudah memiliki akun pengguna.');
        }

        return view('admin.employees.create-user', compact('employee'));
    }

    public function storeUser(Request $request, Employee $employee)
    {
        if ($employee->user) {
            return redirect()
                ->route('admin.employees.show', $employee->id)
                ->with('error', 'Pegawai ini sudah memiliki akun pengguna.');
        }

        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $employee->nama_lengkap,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'employee',
        ]);

        $employee->user_id = $user->id;
        $employee->save();

        return redirect()
            ->route('admin.employees.show', $employee->id)
            ->with('success', 'Akun pengguna untuk pegawai berhasil dibuat.');
    }

    public function editUser(Employee $employee)
    {
        if (!$employee->user) {
            return redirect()
                ->route('admin.employees.show', $employee->id)
                ->with('error', 'Pegawai ini belum memiliki akun login.');
        }

        $user = $employee->user;

        return view('admin.employees.edit-user', compact('employee', 'user'));
    }

    public function updateUser(Request $request, Employee $employee)
    {
        if (!$employee->user) {
            return redirect()
                ->route('admin.employees.show', $employee->id)
                ->with('error', 'Pegawai ini belum memiliki akun login.');
        }

        $user = $employee->user;

        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.employees.show', $employee->id)
            ->with('success', 'Informasi akun login berhasil diperbarui.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\AdminsExport;
use App\Exports\StaffsExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function exportAdmin() 
    {
        return Excel::download(new AdminsExport, 'admin-users.xlsx');
    }

    public function exportStaff() 
    {
        return Excel::download(new StaffsExport, 'staff-users.xlsx');
    }

    public function indexAdmin() 
    {
        $admins = User::where('role', 'admin')->get();

        return view('admin.users-admin.users-admin', compact('admins'));
    }

    public function indexStaff() 
    {
        $staffs = User::where('role', 'staff')->get();

        return view('admin.users-staff.users-staff', compact('staffs'));
    }

    public function editAdmin(string $id) 
    {
        $admin = User::where('id', $id)->first();

        return view('admin.users-admin.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, string $id) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'nullable',
        ], [
            'name.required' => "Wajib Diisi",
            'email.required' => "Wajib Diisi",
            'role.required' => 'wajib diisi!',
        ]);

        $updateAdmin = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $updateAdmin['password'] = bcrypt($request->password);
        }

        $proses = User::where('id', $id)->update($updateAdmin);

        if ($proses) {
            return redirect()->route('admin.users.admin')->with('success', "Berhasil diupdate");
        } else {
            return redirect()->route('admin.users.admin')->with('failed', 'Gagal diupdate');
        }
    }

    public function editStaff(string $id) 
    {
        $staff = User::where('id', $id)->first();

        return view('staff.user-staff.edit', compact('staff'));
    }

    public function updateStaff(Request $request, string $id) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
        ], [
            'name.required' => "Wajib Diisi",
            'email.required' => "Wajib Diisi",
        ]);

        $updateStaff = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateStaff['password'] = $request->password;
        }

        $proses = User::where('id', $id)->update($updateStaff);

        if ($proses) {
            return redirect()->route('staff.items')->with('success', "Berhasil diupdate");
        } else {
            return redirect()->route('staff.items')->with('failed', 'Gagal diupdate');
        }
    }

    public function createAdmin() 
    {
        return view('admin.users-admin.create');
    }

    public function createStaff() 
    {
        return view('admin.users-staff.create');
    }

    public function storeAdmin(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ], [
            'name.required' => "Wajib Diisi",
            'email.required' => "Wajib Diisi",
            'role.required' => 'wajib diisi!',
        ]);

        $admins = User::where('role', 'admin')->get();
        $nomor = count($admins) == 0 ? 1 : count($admins) + 1;

        $passwordAwal = substr($request->email, 0, 4);

        $proses = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $passwordAwal . $nomor,
        ]);

        if ($proses) {
            return redirect()->route('admin.users.admin')->with('success', "Berhasil dibuat, password : $passwordAwal$nomor");
        } else {
            return redirect()->route('admin.users.admin')->with('failed', 'Gagal dibuat');
        }
    }

    public function storeStaff(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ], [
            'name.required' => "Wajib Diisi",
            'email.required' => "Wajib Diisi",
            'role.required' => 'wajib diisi!',
        ]);

        $staffs = User::where('role', 'staff')->get();
        $nomor = count($staffs) == 0 ? 1 : count($staffs) + 1;

        $passwordAwal = substr($request->email, 0, 4);

        $proses = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $passwordAwal . $nomor,
        ]);

        if ($proses) {
            return redirect()->route('admin.users.staff')->with('success', "Berhasil dibuat, password : $passwordAwal$nomor");
        } else {
            return redirect()->route('admin.users.staff')->with('failed', 'Gagal dibuat');
        }
    }

    public function destroyAdmin(string $id) 
    {
        $proses = User::where('id', $id)->delete();

        if ($proses) {
            return redirect()->route('admin.users.admin')->with('success', 'Berhasil delete');
        } else {
            return redirect()->route('admin.users.admin')->with('failed', 'Gagal delete');
        }
    }

    public function destroyStaff(string $id) 
    {
        $proses = User::where('id', $id)->delete();

        if ($proses) {
            return redirect()->route('admin.users.staff')->with('success', 'Berhasil delete');
        } else {
            return redirect()->route('admin.users.staff')->with('failed', 'Gagal delete');
        }
    }

    public function resetStaff(string $id) 
    {
        $staff = User::where('id', $id)->first();

        $potonganEmail = substr($staff->email, 0, 4);
        $admins = User::all();
        $nomor = count($admins) + 1;

        $proses = $staff->update([
            'password' => $potonganEmail.$nomor
        ]);

        if ($proses) {
            return redirect()->back()->with('success', "Berhasil reset, password: $potonganEmail$nomor");
        } else {
            return redirect()->back()->with('failed', "Gagal Reset Password");
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserManagementInterface;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    private $userManagement;
    private $permission;
    private $role;

    public function __construct(UserManagementInterface $userManagement, PermissionInterface $permission, RoleInterface $role)
    {
        $this->userManagement = $userManagement;
        $this->permission     = $permission;
        $this->role           = $role;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->userManagement->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('role', function ($data) {
                    return ucwords(str_replace('_', ' ', $data->getRoleNames()->first()));
                })
                ->addColumn('permission', function ($data) {
                    return view('admin.user-management.column.permissions', [
                        'permissions' => $data->getAllPermissions(),
                    ]);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.user-management.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.user-management.index');
    }

    public function getById($id)
    {
        return response()->json($this->userManagement->getById($id));
    }

    public function create()
    {
        return view('admin.user-management.create', [
            'roles'       => $this->role->get(),
            'permissions' => $this->permission->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email',
            'role'        => 'required',
            'permissions' => 'array|nullable',
        ]);

        try {
            $this->userManagement->store($validate);
            return redirect()->route('admin.user-management.index')->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.user-management.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.user-management.edit', [
            'user'        => $this->userManagement->getById($id),
            'permissions' => $this->permission->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        try {
            $this->userManagement->update($id, $request->all());
            return redirect()->route('admin.user-management.index')->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('admin.user-management.index')->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $this->userManagement->delete($id);
            return response()->json(['status' => 'success', 'message' => 'Pengguna berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required|array',
        ]);
        try {
            $this->userManagement->updatePermission($id, $request->permission);
            return redirect()->route('admin.user-management.index')->with('success', 'Hak akses pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('admin.user-management.index')->with('error', $th->getMessage());
        }
    }
}

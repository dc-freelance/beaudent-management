<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BranchInterface;
use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserManagementInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    private $userManagement;

    private $permission;

    private $role;

    private $branch;

    public function __construct(UserManagementInterface $userManagement, PermissionInterface $permission, RoleInterface $role, BranchInterface $branch)
    {
        $this->userManagement = $userManagement;
        $this->permission = $permission;
        $this->role = $role;
        $this->branch = $branch;
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
                ->addColumn('phone_number', function ($data) {
                    return $data->phone_number;
                })
                ->addColumn('role', function ($data) {
                    return ucwords(str_replace('_', ' ', $data->getRoleNames()->first()));
                })
                ->addColumn('branch', function ($data) {
                    return $data->branch->name ?? '-';
                })
                ->addColumn('join_date', function ($data) {
                    return Carbon::parse($data->join_date)->locale('id')->isoFormat('LL');
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
        $roles = $this->role->get();

        return view('admin.user-management.create', [
            'roles' => $roles,
            'branches' => $this->branch->get()->where('id', '!=', 1),
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'phone_number' => 'required',
            'branch_id' => 'nullable|exists:branches,id',
            'join_date' => 'required',
        ]);

        if (!$request->has('branch_id')) {
            $request['branch_id'] = $this->branch->getById(1)->id;
        }

        try {
            $this->userManagement->store($request->all());

            return redirect()->route('admin.user-management.index')->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.user-management.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $user = $this->userManagement->getById($id);
        $role = $user->roles()->pluck('name');

        return view('admin.user-management.edit', [
            'data' => $user,
            'roles' => $this->role->get(),
            'branches' => $this->branch->get()->where('id', '!=', 1),
            'this_role' => $this->role->getByName($role)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'phone_number' => 'required',
            'branch_id' => 'nullable|exists:branches,id',
            'join_date' => 'required',
        ]);

        if (!$request->has('branch_id')) {
            $request['branch_id'] = $this->branch->getById(1)->id;
        }

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


    public function resetUserPassword($id)
    {
        $user = $this->userManagement->getById($id);

        try {
            $user->password = Hash::make('password');
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Password berhasil di reset']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}

<?php

namespace App\Repositories;

use App\Interfaces\UserManagementInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UserManagementRepository implements UserManagementInterface
{
    private $user;
    private $permission;

    public function __construct(User $user, Permission $permission)
    {
        $this->user       = $user;
        $this->permission = $permission;
    }

    public function get()
    {
        return $this->user->with(['branch'])->get();
    }

    public function getById($id)
    {
        return $this->user->find($id);
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $password = bcrypt('password');
            $user     = $this->user->create(array_merge($data, ['password' => $password]));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        try {
            $user->assignRole($data['role']);
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        DB::commit();
    }

    public function update($id, $data)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->find($id);
            $user->update($data);
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        try {
            $user->syncRoles($data['role']);
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        DB::commit();
    }

    public function delete($id)
    {
        try {
            return $this->user->find($id)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updatePermission($id, $data)
    {
        try {
            $user = $this->user->find($id);
            $user->syncPermissions($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

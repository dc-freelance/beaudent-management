<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function get()
    {
        return $this->role->all();
    }

    public function getById($id)
    {
        return $this->role->find($id);
    }

    public function store($data)
    {
        try {
            return $this->role->create($data->all());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        try {
            return $this->role->find($id)->update($data->all());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            return $this->role->find($id)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

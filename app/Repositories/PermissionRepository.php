<?php

namespace App\Repositories;

use App\Interfaces\PermissionInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function get()
    {
        return $this->permission->all();
    }

    public function getById($id)
    {
        return $this->permission->find($id);
    }

    public function store($request)
    {
        $this->permission->create($request->all());
    }

    public function update($id, $request)
    {
        $this->permission->find($id)->update($request->all());
    }

    public function delete($id)
    {
        $this->permission->find($id)->delete();
    }
}

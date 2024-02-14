<?php

namespace App\Interfaces;

interface UserManagementInterface
{
    public function get();
    public function getById($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
    public function updatePermission($id, $data);
}

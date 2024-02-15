<?php

namespace App\Interfaces;

interface PermissionInterface
{
    public function get();
    public function getById($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
}

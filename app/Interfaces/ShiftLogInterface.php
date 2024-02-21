<?php

namespace App\Interfaces;

interface ShiftLogInterface
{
    public function get();

    public function getById($id);

    public function store($data);

    public function update($id, $data);

    public function delete($id);

    public function validation_open_shift();

    public function validation_close_shift();
}

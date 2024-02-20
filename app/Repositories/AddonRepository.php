<?php

namespace App\Repositories;

use App\Interfaces\AddonInterface;
use App\Models\Addon;

class AddonRepository implements AddonInterface
{
    private $addon;

    public function __construct(Addon $addon)
    {
        $this->addon = $addon;
    }

    public function get()
    {
        return $this->addon->all()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->addon->find($id);
    }

    public function store($data)
    {
        $this->addon->create($data);
    }

    public function update($id, $data)
    {
        $addon = $this->addon->find($id);
        $addon->update($data);
    }

    public function delete($id)
    {
        $addon = $this->addon->find($id);
        $addon->delete();
    }
}

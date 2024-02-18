<?php

namespace App\Repositories;

use App\Interfaces\ItemUnitInterface;
use App\Models\Unit;

class ItemUnitRepository implements ItemUnitInterface
{
    private $unit;

    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }

    public function get()
    {
        return $this->unit->get()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->unit->find($id);
    }

    public function store($data)
    {
        return $this->unit->create($data);
    }

    public function update($id, $data)
    {
        return $this->unit->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->unit->find($id)->delete();
    }
}

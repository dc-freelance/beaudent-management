<?php

namespace App\Repositories;

use App\Interfaces\ItemUnitInterface;
use App\Models\Item;
use App\Models\Unit;

class ItemUnitRepository implements ItemUnitInterface
{
    private $itemUnit;
    private $item;

    public function __construct(Unit $itemUnit, Item $item)
    {
        $this->itemUnit = $itemUnit;
        $this->item = $item;
    }

    public function get()
    {
        return $this->itemUnit->get()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->itemUnit->find($id);
    }

    public function store($data)
    {
        return $this->itemUnit->create($data);
    }

    public function update($id, $data)
    {
        return $this->itemUnit->find($id)->update($data);
    }

    public function delete($id)
    {
        $this->item->where('category_id', $id)->update(['category_id' => 1]);
        return $this->itemUnit->find($id)->delete();
    }
}

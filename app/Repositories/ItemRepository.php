<?php

namespace App\Repositories;

use App\Interfaces\ItemInterface;
use App\Models\Item;

class ItemRepository implements ItemInterface
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function get()
    {
        return $this->item->all()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->item->find($id);
    }

    public function store($data)
    {
        $this->item->create($data);
    }

    public function update($id, $data)
    {
        $item = $this->item->find($id);
        $item->update($data);
    }

    public function delete($id)
    {
        $item = $this->item->find($id);
        $item->delete();
    }
}

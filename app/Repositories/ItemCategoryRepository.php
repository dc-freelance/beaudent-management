<?php

namespace App\Repositories;

use App\Interfaces\ItemCategoryInterface;
use App\Models\Item;
use App\Models\ItemCategory;

class ItemCategoryRepository implements ItemCategoryInterface
{
    private $itemCategory;
    private $item;

    public function __construct(ItemCategory $itemCategory, Item $item)
    {
        $this->itemCategory = $itemCategory;
        $this->item = $item;
    }

    public function get()
    {
        return $this->itemCategory->get()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->itemCategory->find($id);
    }

    public function store($data)
    {
        return $this->itemCategory->create($data);
    }

    public function update($id, $data)
    {
        return $this->itemCategory->find($id)->update($data);
    }

    public function delete($id)
    {
        $this->item->where('category_id', $id)->update(['category_id' => 1]);
        return $this->itemCategory->find($id)->delete();
    }
}

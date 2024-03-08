<?php

namespace App\Repositories;

use App\Interfaces\DiscountItemInterface;
use App\Models\Discount_Items;

class DiscountItemRepository implements DiscountItemInterface
{
    private $discount_item;

    public function __construct(Discount_Items $discount_item)
    {
        $this->discount_item = $discount_item;
    }

    public function get()
    {
        return $this->discount_item->get();
    }

    public function getById($id)
    {
        return $this->discount_item->find($id);
    }

    private function setDiscountRate($discountType, $DiscountRate)
    {
        if ($discountType == 'nominal') {
            return str_replace('.', '', $DiscountRate);
        }

        return $DiscountRate;
    }

    public function create($data)
    {
        $data['discount'] = $this->setDiscountRate($data['discount_type'], $data['discount']);
        return $this->discount_item->create($data);
    }

    public function update($id, $data)
    {
        $data['discount'] = $this->setDiscountRate($data['discount_type'], $data['discount']);
        return $this->discount_item->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->discount_item->find($id)->delete();
    }
}

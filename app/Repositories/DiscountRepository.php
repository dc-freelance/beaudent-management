<?php

namespace App\Repositories;

use App\Interfaces\DiscountInterface;
use App\Models\Discount;

class DiscountRepository implements DiscountInterface
{
    private $discount;

    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    public function get()
    {
        return $this->discount->get();
    }

    public function getById($id)
    {
        return $this->discount->find($id);
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
        return $this->discount->create($data);
    }

    public function update($id, $data)
    {
        $data['discount'] = $this->setDiscountRate($data['discount_type'], $data['discount']);
        return $this->discount->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->discount->find($id)->delete();
    }
}

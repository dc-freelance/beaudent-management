<?php

namespace App\Repositories;

use App\Interfaces\DiscountTreatmentInterface;
use App\Models\Discount_Treatments;

class DiscountTreatmentRepository implements DiscountTreatmentInterface
{
    private $discount_treatment;

    public function __construct(Discount_Treatments $discount_treatment)
    {
        $this->discount_treatment = $discount_treatment;
    }

    public function get()
    {
        return $this->discount_treatment->get();
    }

    public function getById($id)
    {
        return $this->discount_treatment->find($id);
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
        return $this->discount_treatment->create($data);
    }

    public function update($id, $data)
    {
        $data['discount'] = $this->setDiscountRate($data['discount_type'], $data['discount']);
        return $this->discount_treatment->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->discount_treatment->find($id)->delete();
    }
}

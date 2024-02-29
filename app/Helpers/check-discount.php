<?php

use App\Models\Discount;
use App\Models\Discount_Items;
use App\Models\Discount_Treatments;

function checkDiscountItem($itemId, $createdAt)
{
    $checkDiscount = Discount_Items::with('discounts')
                                    ->whereRelation('discounts', 'is_active', 1)
                                    ->whereRelation('discounts', 'start_date', '<=', $createdAt)
                                    ->whereRelation('discounts', 'end_date', '>=', $createdAt)
                                    ->where('item_id', $itemId)
                                    ->first();
    return $checkDiscount;
}

function checkDiscountTreatment($treatmentId, $createdAt)
{
    $checkDiscount = Discount_Treatments::with('discounts')
                                    ->whereRelation('discounts', 'is_active', 1)
                                    ->whereRelation('discounts', 'start_date', '<=', $createdAt)
                                    ->whereRelation('discounts', 'end_date', '>=', $createdAt)
                                    ->where('treatment_id', $treatmentId)
                                    ->first();

    // dd($checkDiscount);
    return $checkDiscount;
}
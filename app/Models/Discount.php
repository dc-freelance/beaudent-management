<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'discount_type',
        'discount',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function getDiscount()
    {
        return $this->get();
    }

    public function discount_items()
    {
        return $this->hasMany(Discount_Items::class, 'discount_id', 'id');
    }

    public function discount_treatment()
    {
        return $this->hasMany(Discount_Treatmens::class, 'discount_id', 'id');
    }

    public function getDiscountById($id)
    {
        return $this->where('id', $id)->first();
    }
}

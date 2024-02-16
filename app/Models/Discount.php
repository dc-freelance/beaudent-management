<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $guarded = []; 

    public function discount_items()
    {
        return $this->hasMany(Discount_Items::class, 'discount_id', 'id');
    }

    public function discount_treatment()
    {
        return $this->hasMany(Discount_Treatmens::class, 'discount_id', 'id');
    }
}
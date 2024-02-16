<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount_Treatments extends Model
{
    use HasFactory;

    protected $table = 'discount_treatments';

    protected $guarded = [];

    public function discounts()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }

    public function discount_treatments()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id', 'id');
    }
}

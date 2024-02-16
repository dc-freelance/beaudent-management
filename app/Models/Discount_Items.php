<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount_Items extends Model
{
    use HasFactory;

    protected $table = 'discount_items';
    protected $guarded = []; 

    public function discounts()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
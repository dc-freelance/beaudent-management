<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $guarded = [];
    
    public function discount_items()
    {
        return $this->hasMany(Discount_Items::class, 'item_id', 'id');
    }
}
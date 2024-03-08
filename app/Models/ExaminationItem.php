<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationItem extends Model
{
    use HasFactory;

    protected $table = 'examination_items';
    protected $guarded = [];

    // add relation

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
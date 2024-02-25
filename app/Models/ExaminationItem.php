<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'examination_id',
        'item_id',
        'qty',
        'sub_total'
    ];

    // add relation
}

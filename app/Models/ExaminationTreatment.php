<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationTreatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'examination_id',
        'treatment_id',
        'qty',
        'sub_total'
    ];

    // add relation
}

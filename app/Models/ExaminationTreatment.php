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
    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreatmentCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'treatment_categories';
    protected $guarded = [];

    public function treatment_categories()
    {
        return $this->hasMany(Treatment::class, 'treatment_category_id', 'id');
    }
}

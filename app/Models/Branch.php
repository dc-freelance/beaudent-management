<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Branch extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $table = 'branches';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function sequences()
    {
        return $this->hasMany(Sequence::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'branch_id', 'id');
    }
}

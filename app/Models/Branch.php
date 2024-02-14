<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Branch extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'branches';

    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

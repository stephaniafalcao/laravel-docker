<?php

namespace App\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'action'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

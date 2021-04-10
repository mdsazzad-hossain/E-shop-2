<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'user_id', 'role'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\User');
    }
}

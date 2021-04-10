<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildMenu extends Model
{
    protected $guarded = [];


    public function get_menu()
    {
        return $this->belongsTo(Menu::class,'id');
    }
}

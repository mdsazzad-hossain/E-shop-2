<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function get_child_menu()
    {
        return $this->hasMany(ChildMenu::class,'menu_id');
    }
}

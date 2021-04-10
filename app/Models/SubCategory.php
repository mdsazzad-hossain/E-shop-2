<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\User;

class SubCategory extends Model
{
    protected $fillable = [
        'role_id',
        'category_id',
        'name',
        'description',
        'status',
        'image',
        'hide',
    ];

    public function getUser()
    {
        return $this->belongsTo('App\User');
    }

    public function get_category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}

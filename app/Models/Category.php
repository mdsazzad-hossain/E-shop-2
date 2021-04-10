<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\User;
class Category extends Model
{
    // protected $gurded = [];
    protected $fillable = [
        'name', 'description', 'image','role_id','hide','status'
    ];

    public function get_user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function get_sub_category()
    {
        return $this->hasMany(SubCategory::class,'category_id');
    }
}

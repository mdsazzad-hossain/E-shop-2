<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'name','msg'
    ];
    public function get_sub_test()
    {
        return $this->hasMany(SubTest::class,'test_id');
    }
}

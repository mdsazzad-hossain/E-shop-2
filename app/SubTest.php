<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTest extends Model
{
    protected $fillable = [
        'name', 'email', 'msg','test_id'
    ];

    public function get_test()
    {
        return $this->belongsTo(Test::class,'test_id');
    }


}

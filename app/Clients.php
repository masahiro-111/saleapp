<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');
    //
    public static $rules = array(
        'pic_name' => 'required',
        'corp_name' => 'required',
    );
}

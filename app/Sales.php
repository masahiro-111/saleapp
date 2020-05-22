<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes;

    protected $guarded = array('id');
    //

    public static $rules = array(
        'title' => 'required',
        'content' => 'required',
        'location' => 'required',
        'skill' => 'required',
        'term' => 'required',
    );

}

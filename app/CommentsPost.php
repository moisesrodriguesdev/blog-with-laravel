<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentsPost extends Model
{
    protected $table = 'comments';

    protected $fillable = ['post_id', 'comment'];

    protected $dates = ['created_at','updated_at'];

    //data formatada m-d-Y
    protected $appends = ['data2'];


    public function getData2Attribute()
    {
        return date('d/m/Y', strtotime($this->attributes['created_at']));
    }
}

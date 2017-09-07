<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['username', 'email', 'site', 'content', 'display', 'commentable_type', 'commentable_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

}

<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

}

<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected $fillable = ['username', 'email', 'site', 'content', 'display', 'commentable_type', 'commentable_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

}

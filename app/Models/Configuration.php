<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected $table = 'admin_config';
}

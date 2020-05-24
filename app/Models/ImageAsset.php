<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class ImageAsset extends Model
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected $table = 'admin_image_assets';
}

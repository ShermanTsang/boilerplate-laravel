<?php

namespace App\Admin\Repositories;

use App\Models\Advertise as AdvertiseModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Advertise extends EloquentRepository
{
    protected $eloquentClass = AdvertiseModel::class;
}

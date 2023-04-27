<?php

namespace App\Admin\Repositories;

use App\Models\Banner as BannerModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Banner extends EloquentRepository
{
    protected $eloquentClass = BannerModel::class;
}

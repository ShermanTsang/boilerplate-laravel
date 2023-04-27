<?php

namespace App\Admin\Repositories;

use App\Models\Notify as NotifyModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Notify extends EloquentRepository
{
    protected $eloquentClass = NotifyModel::class;
}

<?php

namespace App\Admin\Repositories;

use App\Models\Setting as SettingModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Setting extends EloquentRepository
{
    protected $eloquentClass = SettingModel::class;
}

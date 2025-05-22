<?php

namespace App\Admin\Repositories;

use App\Models\Administrator as AdministratorModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Administrator extends EloquentRepository
{
    protected $eloquentClass = AdministratorModel::class;
}

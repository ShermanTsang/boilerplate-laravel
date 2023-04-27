<?php

namespace App\Admin\Repositories;

use App\Models\Staff as StaffModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Staff extends EloquentRepository
{
    protected $eloquentClass = StaffModel::class;
}

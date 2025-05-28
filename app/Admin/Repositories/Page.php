<?php

namespace App\Admin\Repositories;

use App\Models\Page as PageModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Page extends EloquentRepository
{
    protected $eloquentClass = PageModel::class;
}
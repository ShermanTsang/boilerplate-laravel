<?php

namespace App\Admin\Repositories;

use App\Models\Post as PostModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Post extends EloquentRepository
{
    protected $eloquentClass = PostModel::class;
}

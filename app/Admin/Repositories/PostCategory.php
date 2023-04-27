<?php

namespace App\Admin\Repositories;

use App\Models\PostCategory as PostCategoryModel;
use Dcat\Admin\Repositories\EloquentRepository;

class PostCategory extends EloquentRepository
{
    protected $eloquentClass = PostCategoryModel::class;
}

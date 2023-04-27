<?php

namespace App\Admin\Repositories;

use App\Models\Comment as CommentModel;
use Dcat\Admin\Repositories\EloquentRepository;

class Comment extends EloquentRepository
{
    protected $eloquentClass = CommentModel::class;
}

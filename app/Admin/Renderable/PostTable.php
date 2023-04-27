<?php

namespace App\Admin\Renderable;

use App\Models\Post;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class PostTable extends LazyRenderable
{
    public function grid(): Grid
    {
        $id = $this->id;

        return Grid::make(Post::with(['postCategory']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('postCategory.name', '分类')->sortable()->filter();
            $grid->column('name')->copyable()->sortable();
            $grid->column('coverImage')->image('', 120, 80);
            $grid->column('description')->limit(20);
            $grid->column('isFeatured')->using([true => '是', false => '否'])->dot([false => 'danger', true => 'success',], 'primary');

            $grid->column('created_at')->sortable()->view('datetime');
            $grid->column('updated_at')->sortable()->view('datetime');

            $grid->quickSearch(['id', 'name', 'description']);

            $grid->paginate(10);
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('channel.name')->width(4);
                $filter->like('name')->width(4);
            });
        });
    }
}

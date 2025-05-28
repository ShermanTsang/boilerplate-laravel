<?php

namespace App\Admin\Renderable;

use App\Models\Page;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class PageTable extends LazyRenderable
{
    public function grid(): Grid
    {
        $id = $this->id;

        return Grid::make(Page::class, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name')->copyable()->sortable();
            $grid->column('sign')->copyable()->sortable();
            $grid->column('type')->using([
                'external_url' => 'External URL',
                'content' => 'Content'
            ])->dot([
                'external_url' => 'primary',
                'content' => 'success'
            ]);
            $grid->column('cover_image')->image('', 120, 80);
            $grid->column('is_enabled')->using([true => '是', false => '否'])->dot([
                false => 'danger',
                true => 'success'
            ], 'primary');
            $grid->column('description')->limit(30);

            $grid->column('created_at')->sortable()->view('datetime');
            $grid->column('updated_at')->sortable()->view('datetime');

            $grid->quickSearch(['id', 'name', 'sign', 'description']);

            $grid->paginate(10);
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name')->width(4);
                $filter->like('sign')->width(4);
                $filter->equal('type')->select([
                    'external_url' => 'External URL',
                    'content' => 'Content'
                ])->width(4);
            });
        });
    }
}
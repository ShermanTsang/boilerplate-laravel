<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class PageController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(Page::class, function (Form $form) {
            $form->text('name')->rules('max:255|min:2')->required();
            $form->text('sign')->rules('max:255|min:2')->required();
            $form->select('type')->options([
                'external_url' => 'External URL',
                'content' => 'Content'
            ])->required();
            $form->image('cover_image')->move('images/page')->uniqueName()->autoUpload()
                ->compress([
                    'quality' => 90,
                    'allowMagnify' => false,
                    'crop' => false,
                    'preserveHeaders' => true,
                    'noCompressIfLarger' => false,
                    'compressSize' => 0
                ]);
            $form->switch('is_enabled')->default(true);
            $form->url('external_url')->when('type', 'external_url', function (Form $form) {
                $form->required();
            });
            $form->editor('content')->imageDirectory('images/page/editor')->when('type', 'content', function (Form $form) {
                $form->required();
            });
            $form->textarea('description');
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Page::class, function (Grid $grid) {
            // Fields
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

            $grid->column('datetime')->display(function () {
                return [
                    ["name" => '创建', 'field' => 'created_at', 'type' => 'datetime'],
                    ["name" => '更新', 'field' => 'updated_at', 'type' => 'datetime'],
                ];
            })->view('admin.grid.mix');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name');
                $filter->like('sign');
                $filter->equal('type')->select([
                    'external_url' => 'External URL',
                    'content' => 'Content'
                ]);
                $filter->equal('is_enabled')->select([1 => '是', 0 => '否']);
            });
            $grid->quickSearch(['id', 'name', 'sign']);

            // Configurations
            $grid->showColumnSelector();
            $grid->setDialogFormDimensions('80%', '75%');
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, Page::class, function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('sign');
            $show->field('type');
            $show->field('cover_image')->image();
            $show->field('is_enabled')->using([true => '是', false => '否']);
            $show->field('external_url')->link();
            $show->field('description');

            $show->field('created_at')->view('datetime');
            $show->field('updated_at')->view('datetime');

            $show->divider();
            $show->html(function () {
                return $this->content;
            });
        });
    }
}
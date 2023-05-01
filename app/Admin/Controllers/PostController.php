<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class PostController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(post::with(['postCategory']), function (Form $form) {
            $form->select('categoryId')->options(PostCategory::class, 'id', 'name')->ajax('/api/option/postCategory')->required();
            $form->text('name')->rules('max:60|min:2')->required();
            $form->image('coverImage')->move('images/post')->uniqueName()->autoUpload()
                ->compress([
                    'quality' => 90,
                    'allowMagnify' => false,
                    'crop' => false,
                    'preserveHeaders' => true,
                    'noCompressIfLarger' => false,
                    'compressSize' => 0
                ]);
            $form->text('description')->required();
            $form->editor('content')->required()->imageDirectory('images/post/editor');
            $form->slider('order')->default(-1)->options(['max' => 100, 'min' => -1, 'step' => 1, 'postfix' => '文章顺序']);;
            $form->switch('isFeatured');
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(post::with(['postCategory']), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('postCategory.name', '分类')->sortable()->filter();
            $grid->column('name')->copyable()->sortable();
            $grid->column('coverImage')->image('', 120, 80);
            $grid->column('description')->limit(20);
            $grid->column('isFeatured')->using([true => '是', false => '否'])->dot([false => 'danger', true => 'success',], 'primary');

            $grid->column('created_at')->sortable()->view('datetime');
            $grid->column('updated_at')->sortable()->view('datetime');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name');
            });
            $grid->quickSearch(['id', 'name']);

            // Configurations
//            $grid->showQuickEditButton();
            $grid->showColumnSelector();
//            $grid->disableEditButton();
//            $grid->enableDialogCreate();
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
        return Show::make($id, post::with(['postCategory']), function (Show $show) {
            $show->field('id');
            $show->field('postCategory.name', '类别');
            $show->field('name');
            $show->field('order');

            $show->field('created_at')->view('datetime');
            $show->field('updated_at')->view('datetime');

            $show->divider();
            $show->html(function () {
                return $this->content;
            });
        });
    }
}

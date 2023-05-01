<?php

namespace App\Admin\Controllers;

use App\Models\PostCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class PostCategoryController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(new PostCategory(), function (Form $form) {
            $form->text('name')->required();
            $form->text('description')->required();
            $form->image('coverImage')->move('images/postCategory/cover')->uniqueName()->autoUpload()
                ->compress([
                    'quality' => 90,
                    'allowMagnify' => false,
                    'crop' => false,
                    'preserveHeaders' => true,
                    'noCompressIfLarger' => false,
                    'compressSize' => 0
                ]);
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PostCategory(), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('name')->sortable()->editable();
            $grid->column('description')->limit(14, '...');
            $grid->column('coverImage')->image('', 120, 80);

            $grid->column('created_at')->sortable()->view('datetime');
            $grid->column('updated_at')->sortable()->view('datetime');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name');
                $filter->like('description');
            });
            $grid->quickSearch(['id', 'name', 'description']);

            // Configurations
            $grid->showQuickEditButton();
            $grid->showColumnSelector();
            $grid->disableEditButton();
            $grid->enableDialogCreate();
            $grid->setDialogFormDimensions('50%', '50%');

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
        return Show::make($id, new PostCategory(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('coverImage')->image('', 120, 80);
            $show->field('description');

            $show->field('created_at')->view('datetime');
            $show->field('updated_at')->view('datetime');
        });
    }
}

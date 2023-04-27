<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Advertise;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class AdvertiseController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(new Advertise(), function (Form $form) {
            $form->text('name')->rules('max:14|min:2')->required();
            $form->text('position')->rules('max:14|min:2')->required();
            $form->text('positionSign')->rules('regex:/^[a-zA-Z]+(\.[a-zA-Z]+)*$/|max:60|min:2')->required()->help('创建后请勿修改此项');
            $form->image('image')->move('images/advertise')->uniqueName()->autoUpload()
                ->compress([
                    'quality' => 90,
                    'allowMagnify' => false,
                    'crop' => false,
                    'preserveHeaders' => true,
                    'noCompressIfLarger' => false,
                    'compressSize' => 0
                ]);
            $form->text('pagePath')->help('填写用户端的页面地址时，用户点击 广告 后将直接跳转到对应页面，而不显示下面的内容');
            $form->editor('content')->imageDirectory('images/advertise/editor');
            $form->switch('isValid');
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Advertise(), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('name')->copyable()->sortable();
            $grid->column('pagePath')->copyable();
            $grid->column('image')->image('', 120, 80);
            $grid->column('isValid')->using([true => '有效', false => '无效'])->dot([false => 'danger', true => 'success',], 'primary');

            $grid->column('created_at')->sortable()->view('datetime');
            $grid->column('updated_at')->sortable()->view('datetime');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name', 'position');
            });
            $grid->quickSearch(['id', 'name', 'position']);

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
        return Show::make($id, new Advertise(), function (Show $show) {
            $show->field('id');
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

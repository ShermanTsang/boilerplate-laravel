<?php

namespace App\Admin\Controllers;

use App\Page;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PageController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('单页系统');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('修改单页');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('添加单页');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Page::class, function (Grid $grid) {

            $grid->model()->orderBy('created_at', 'desc');
            $grid->name('名称');
            $grid->link('连接')->editable();
            $grid->order('顺序')->editable();
            $grid->created_at('创建时间');
            $states = [
                'on' => ['value' => 1, 'text' => '显示', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'default'],
            ];
            $grid->display()->switch($states);

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Page::class, function (Form $form) {
            $form->display('id');
            $form->text('name', '页面名称');
            $form->text('link', '连接');
            $form->image('image', '图片')->move('PageCover');
            $form->number('order', '顺序');
            $form->textarea('description', '简述');
            $form->simditor('content', '内容');
            $states = [
                'on' => ['value' => 1, 'text' => '显示', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
            ];
            $form->switch('isDisplay', '是否显示')->states($states)->default(1);
        });
    }
}

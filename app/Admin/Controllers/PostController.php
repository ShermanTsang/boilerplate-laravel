<?php

namespace App\Admin\Controllers;

use App\Post;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PostController extends Controller
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

            $content->header('内容');
            $content->description('管理');

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

            $content->header('内容');
            $content->description('编辑');

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

            $content->header('内容');
            $content->description('新增');

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
        return Admin::grid(Post::class, function (Grid $grid) {

            $grid->model()->orderBy('updated_at', 'desc');

            $grid->category()->sortable();
            $grid->title()->editable();
            $grid->status()->editable();
            $grid->created_at()->editable('datetime');
            $grid->view_count()->editable()->sortable();
            $states = [
                'on' => ['value' => 1, 'text' => '显示', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'default'],
            ];
            $grid->display()->switch($states);

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->like('title', 'title');
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
        return Admin::form(Post::class, function (Form $form) {

            $form->editormd('content', '内容');

            $form->tab('基础信息', function ($form) {

                $form->text('title', '标题');
                $form->text('status', '状态');
                $form->datetime('created_at', '创建时间')->default(date('Y-m-d HH:mm:ss'))->format('YYYY-MM-DD HH:mm:ss');
                $form->text('category', '分类');
                $form->image('image')->move('postImages')->uniqueName();
                $states = [
                    'on' => ['value' => 1, 'text' => '显示', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
                ];
                $form->switch('display', 'display')->states($states)->default(1);

            })->tab('内容编辑', function ($form) {

                $form->textarea('description', '描述');
//                $form->simditor('content','内容');

            });

        });
    }
}

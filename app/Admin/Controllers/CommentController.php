<?php

namespace App\Admin\Controllers;

use App\Comment;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CommentController extends Controller
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

            $content->header('评论');
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

            $content->header('评论');
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

            $content->header('评论');
            $content->description('创建');

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
        return Admin::grid(Comment::class, function (Grid $grid) {

            $grid->username()->editable();
            $grid->email();
            $grid->site()->editable();
            $grid->commentable_id()->editable();
            $grid->content()->limit(50);
            $states = [
                'on' => ['value' => 1, 'text' => '显示', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'default'],
            ];
            $grid->display()->switch($states);

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->like('content', 'content');
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
        return Admin::form(Comment::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('username', 'username');
            $form->text('email', 'email');
            $form->text('site', 'site');
            $form->number('commentable_id', 'commentable_id');
            $form->text('content', 'content');
            $states = [
                'on' => ['value' => 1, 'text' => '显示', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
            ];
            $form->switch('display', 'display')->states($states)->default(1);
        });
    }
}

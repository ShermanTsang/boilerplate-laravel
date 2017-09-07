<?php

namespace App\Admin\Controllers;

use App\Issue;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class IssueController extends Controller
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

            $content->header('工单系统');
            $content->description('反馈问题');

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

            $content->header('修改工单');
            $content->description('反馈问题');

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

            $content->header('添加工单');
            $content->description('反馈问题');

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
        return Admin::grid(Issue::class, function (Grid $grid) {

            $grid->model()->orderBy('created_at', 'desc');
            $grid->category('问题分类');
            $grid->status('状态');
            $grid->title('问题标题')->editable();
            $grid->created_at('提出时间');
            $grid->fixTime('解决时间');

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->like('category', '问题分类');
                $filter->like('title', '问题标题');
                $filter->like('content', '问题描述');
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
        return Admin::form(Issue::class, function (Form $form) {
            $form->display('id');
            $form->select('category')->options(['其他问题' => '其他问题', 'BUG修复' => 'BUG修复', '界面优化' => '界面优化', '功能优化' => '功能优化', '排版问题' => '排版问题', '后台问题' => '后台问题', '使用疑惑' => '使用疑惑', '网站报错' => '网站报错', '新增功能' => '新增功能'])->default('其他问题');
            $form->text('name', '提出人')->value(Admin::user()->name);
            $form->text('title', '问题标题');
            $form->image('image', '相关图片')->move('IssueImage');
            $form->file('file', '相关文件')->move('IssueFile');
            $form->textarea('content', '具体描述')->help('对问题的具体描述，如果标题已经说清楚可以不填写');
            $form->select('status')->options(['已提出未查看' => '已提出未查看', '已经查看' => '已经查看', '解决中' => '解决中', '已解决' => '已解决', '需进一步讨论' => '需进一步讨论'])->default('已提出未查看');
            $form->simditor('memo');
            $form->datetime('fixTime', '修复时间')->default(date('y-m-d h:i:s',time()));
        });
    }
}

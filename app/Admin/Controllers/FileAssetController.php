<?php

namespace App\Admin\Controllers;

use App\FileAsset;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FileAssetController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('文件资源');
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

            $content->header('文件资源');
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

            $content->header('文件资源');
            $content->description('新建');

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
        return Admin::grid(FileAsset::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');
            $grid->key('资源标识')->editable();
            $grid->name('资源名称')->sortable();
            $grid->url('文件地址')->limit(30);
            $grid->description('配置描述')->limit(30);

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->like('title', '设置项');
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
        return Admin::form(FileAsset::class, function (Form $form) {
            $form->display('id');
            $form->image('url', '文件上传')->move('FileAsset')->help('请压缩文件之后再上传，否则会造成网站访问速度慢');
            $form->text('key', '资源标识')->help('非技术人员，请不要修改此项');
            $form->text('name', '资源名称')->required();
            $form->textarea('description', '设置描述')->help('非技术人员，请不要修改此项');
        });
    }
}

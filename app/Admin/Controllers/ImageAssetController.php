<?php

namespace App\Admin\Controllers;

use App\ImageAsset;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ImageAssetController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('图片资源');
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

            $content->header('图片资源');
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

            $content->header('图片资源');
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
        return Admin::grid(ImageAsset::class, function (Grid $grid) {

            $grid->model()->orderBy('key', 'desc');
            $grid->key('资源标识')->editable();
            $grid->name('资源名称')->sortable();
            $grid->url('图片地址')->image(getQiNiuCdnLink(), '100', '60');
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
        return Admin::form(ImageAsset::class, function (Form $form) {
            $form->display('id');
            $form->image('url', '图片上传')->move('ImageAsset')->help('请压缩图片之后再上传，否则会造成网站访问速度慢');
            $form->text('key', '资源标识')->help('非技术人员，请不要修改此项');
            $form->text('name', '资源名称')->required();
            $form->textarea('description', '设置描述')->help('非技术人员，请不要修改此项');
        });
    }
}

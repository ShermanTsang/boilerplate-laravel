<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use App\Models\Profile;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class UserController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(User::with(['profile']), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->mobile('mobile');
            $form->email('email');
            $form->text('profile.bio', '个人介绍');
            $form->image('profile.avatarImage', '头像')->move('images/user/avatar')->uniqueName()->autoUpload()
                ->compress([
                    'quality' => 90,
                    'allowMagnify' => false,
                    'crop' => false,
                    'preserveHeaders' => true,
                    'noCompressIfLarger' => false,
                    'compressSize' => 0
                ]);
            $form->select('profile.gender')->options(Profile::$Gender);

            $id = $form->getKey();
            if ($id) {
                $form->password('password')
                    ->minLength(5)
                    ->maxLength(20)
                    ->customFormat(function () {
                        return '';
                    });
            } else {
                $form->password('password')
                    ->required()
                    ->minLength(5)
                    ->maxLength(20);
            }
            $form->password('password_confirmation', trans('admin.password_confirmation'))->same('password');
            $form->ignore(['password_confirmation']);
        })
            ->saving(function (Form $form) {
                if ($form->password && $form->model()->get('password') != $form->password) {
                    $form->password = bcrypt($form->password);
                }

                if (!$form->password) {
                    $form->deleteInput('password');
                }
            });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(User::with(['profile']), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('name')->sortable()->editable();
            $grid->column('profile.avatarImage', '头像')->image('', 64, 64);
            $grid->column('mobile')->copyable();
            $grid->column('email')->copyable();
            $grid->column('profile.gender', '性别')->using(Profile::$Gender)->filter()->sortable();

            $grid->column('lastLoginAt', '最近登录')->sortable()->view('datetime');
            $grid->column('created_at', '注册时间')->sortable()->view('datetime');
            $grid->column('updated_at', '资料更新时间')->sortable()->view('datetime');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name');
                $filter->like('mobile');
                $filter->equal('gender')->select(Profile::$Gender);
            });
            $grid->quickSearch(['id', 'name', 'mobile']);

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
        return Show::make($id, User::with(['profile']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('email');
            $show->field('profile.gender', '性别');
            $show->field('profile.bio', '简介');
            $show->field('profile.gender')->using(Profile::$Gender);

            $show->field('lastLoginAt', '最近登录')->view('datetime');
            $show->field('created_at', '注册时间')->view('datetime');
            $show->field('updated_at', '资料更新时间')->view('datetime');
        });
    }
}

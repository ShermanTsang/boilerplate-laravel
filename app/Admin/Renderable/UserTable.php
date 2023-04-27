<?php

namespace App\Admin\Renderable;

use App\Admin\Repositories\User;
use App\Models\Profile;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class UserTable extends LazyRenderable
{
    public function grid(): Grid
    {
        $id = $this->id;

        return Grid::make(User::with(['profile']), function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');

            $grid->column('id')->sortable();
            $grid->column('name')->sortable()->editable();
            $grid->column('profile.avatarImage', '头像')->image('', 64, 64);
            $grid->column('mobile')->copyable();
            $grid->column('email')->copyable();
            $grid->column('profile.gender', '性别')->using(Profile::$Gender)->filter()->sortable();

            $grid->column('lastLoginAt', '最近登录')->sortable()->view('datetime');
            $grid->column('created_at', '注册时间')->sortable()->view('datetime');
            $grid->column('updated_at', '资料更新时间')->sortable()->view('datetime');

            $grid->quickSearch(['id', 'name', 'mobile']);

            $grid->paginate(10);
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id')->width(4);
                $filter->like('name')->width(4);
                $filter->like('mobile')->width(4);
            });
        });
    }
}

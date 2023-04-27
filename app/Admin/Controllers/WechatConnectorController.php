<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\UserTable;
use App\Admin\Repositories\WechatConnector;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class WechatConnectorController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(WechatConnector::with(['user']), function (Form $form) {
            $form->display('id');
            $form->selectTable('userId')
                ->title('选择对应用户')
                ->dialogWidth('80%')
                ->from(UserTable::make(['id' => $form->getKey()]))
                ->model(User::class, 'id', 'name')
                ->required();
            $form->text('openId');
            $form->text('unionId');
            $form->text('sessionKey');
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(WechatConnector::with(['user']), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('user.id')->sortable();
            $grid->column('user.name')->sortable();
            $grid->column('user.mobile');

            $grid->column('openId')->limit(20);
            $grid->column('unionId')->limit(20);
            $grid->column('sessionKey')->limit(20);

            $grid->column('expiredAt', '过期时间')->sortable()->view('datetime');
            $grid->column('created_at', '绑定时间')->sortable()->view('datetime');
            $grid->column('updated_at', '更新时间')->sortable()->view('datetime');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('user.name');
                $filter->like('user.mobile');
            });
            $grid->quickSearch(['id', 'user.name', 'user.mobile']);

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
        return Show::make($id, WechatConnector::with(['user']), function (Show $show) {
            $show->field('id');
            $show->field('user.name');
            $show->field('user.name');

            $show->field('expiredAt', '过期时间')->view('datetime');
            $show->field('created_at', '绑定时间')->view('datetime');
            $show->field('updated_at', '更新时间')->view('datetime');
        });
    }
}

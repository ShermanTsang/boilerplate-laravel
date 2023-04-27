<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\UserTable;
use App\Admin\Repositories\Notify;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class NotifyController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(notify::with(['user']), function (Form $form) {
            $form->selectTable('userId')
                ->title('选择对应用户')
                ->dialogWidth('80%')
                ->from(UserTable::make(['id' => $form->getKey()]))
                ->model(User::class, 'id', 'name')
                ->required();
            $form->text('subject')->required();
            $form->multipleImage('images')->move('images/notify')->uniqueName()->autoUpload()
                ->compress([
                    'quality' => 90,
                    'allowMagnify' => false,
                    'crop' => false,
                    'preserveHeaders' => true,
                    'noCompressIfLarger' => false,
                    'compressSize' => 0
                ]);
            $form->editor('content')->required()->imageDirectory('images/notify/editor');
            $form->datetime('readAt');
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(notify::with(['user']), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('user.id', '用户编号')->sortable();
            $grid->column('user.name', '用户名')->sortable();
            $grid->column('subject')->limit(18, '...')->editable();

            $grid->column('readAt', '阅读时间')->sortable()->view('datetime');
            $grid->column('created_at', '发送时间')->sortable()->view('datetime');
            $grid->column('updated_at', '编辑时间')->sortable()->view('datetime');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('subject');
                $filter->like('user.name', '用户名');
                $filter->like('user.mobile', '用户手机号');
            });
            $grid->quickSearch(['id', 'subject', 'user.mobile', 'user.name']);

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
        return Show::make($id, notify::with(['user']), function (Show $show) {
            $show->field('id');
            $show->field('user.id', '用户编号');
            $show->field('user.name', '用户名');
            $show->field('subject');

            $show->field('readAt', '阅读时间')->view('datetime');
            $show->field('created_at', '发送时间')->view('datetime');
            $show->field('updated_at', '编辑时间')->view('datetime');

            $show->divider();
            $show->html(function () {
                return $this->content;
            });
        });
    }
}

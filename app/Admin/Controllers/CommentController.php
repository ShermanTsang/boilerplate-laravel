<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\ItemTable;
use App\Admin\Renderable\PostTable;
use App\Admin\Renderable\UserTable;
use App\Admin\Repositories\Comment;
use App\Models\Comment as CommentModel;
use App\Models\Item;
use App\Models\Post;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;
use Illuminate\Support\Str;

class CommentController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(comment::with(['user']), function (Form $form) {
            if ($form->isCreating()) {
                $form->select('targetType')->options(CommentModel::$targetTypeOptions)->required()
                    ->when('Item', function (Form $form) {
                        $form->selectTable('targetId')
                            ->title('选择对应的藏品')
                            ->dialogWidth('80%')
                            ->from(ItemTable::make(['id' => $form->getKey()]))
                            ->model(Item::class, 'id', 'name')
                            ->required();
                    })
                    ->when('Post', function (Form $form) {
                        $form->selectTable('targetId')
                            ->title('选择对应的内容')
                            ->dialogWidth('80%')
                            ->from(PostTable::make(['id' => $form->getKey()]))
                            ->model(Post::class, 'id', 'name')
                            ->required();
                    });
            }
            if ($form->isEditing()) {
                $form->display('targetType')->with(function ($value) {
                    return CommentModel::$targetTypeOptions[Str::remove('App\\Models\\', $value)];
                });
                if (Str::contains($form->model()->targetType, 'Item')) {
                    $form->selectTable('targetId')
                        ->title('选择对应的藏品')
                        ->dialogWidth('80%')
                        ->from(ItemTable::make(['id' => $form->getKey()]))
                        ->model(Item::class, 'id', 'name')
                        ->required();
                }
                if (Str::contains($form->model()->targetType, 'Post')) {
                    $form->selectTable('targetId')
                        ->title('选择对应的藏品')
                        ->dialogWidth('80%')
                        ->from(ItemTable::make(['id' => $form->getKey()]))
                        ->model(Item::class, 'id', 'name')
                        ->required();
                }
            }
            $form->selectTable('userId')
                ->title('选择对应用户')
                ->dialogWidth('80%')
                ->from(UserTable::make(['id' => $form->getKey()]))
                ->model(User::class, 'id', 'name')
                ->required();
            $form->textarea('text')->required();
            $form->multipleImage('images')->move('images/comment')->uniqueName()->autoUpload()
                ->compress([
                    'quality' => 90,
                    'allowMagnify' => false,
                    'crop' => false,
                    'preserveHeaders' => true,
                    'noCompressIfLarger' => false,
                    'compressSize' => 0
                ]);
            $form->switch('isRecommended');
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(comment::with(['user', 'commentable']), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('targetType')->display(function ($value) {
                return CommentModel::$targetTypeOptions[Str::remove('App\\Models\\', $value)];
            });
            $grid->column('commentable.id', '资源编号');
            $grid->column('commentable.name', '资源名称');
            $grid->column('user.id', '用户编号')->sortable();
            $grid->column('user.name', '用户名')->sortable();
            $grid->column('subject')->limit(18, '...')->editable();
            $grid->column('isRecommended')->using([0 => '否', 1 => '是'])->dot([0 => 'danger', 1 => 'success',], 'info')->sortable();

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
        return Show::make($id, comment::with(['user']), function (Show $show) {
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

<?php

namespace App\Admin\Controllers;

use App\Models\Setting;
use App\Models\Setting as SettingModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class SettingController extends AdminController
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(new Setting(), function (Form $form) {
            $form->text('name')->required();
            $form->text('key')->required()->rules('regex:/^[a-zA-Z]+(\.[a-zA-Z]+)*$/', [
                'regex' => '标识符不符合规则'
            ]);
            $form->select('type')->options(SettingModel::$TypeEnum)
                ->when(['IMAGE_URL'], function (Form $form) {
                    $form->image('value', '图片')->move('images/setting')->uniqueName()->autoUpload()
                        ->compress([
                            'quality' => 90,
                            'allowMagnify' => false,
                            'crop' => false,
                            'preserveHeaders' => true,
                            'noCompressIfLarger' => false,
                            'compressSize' => 0
                        ]);
                })
                ->when(['FILE_URL'], function (Form $form) {
                    $form->file('value', '文件')->move('images/setting')->uniqueName()->autoUpload();
                })
                ->when(['TEXT'], function (Form $form) {
                    $form->text('value', '值');
                })
                ->when(['BOOLEAN'], function (Form $form) {
                    $form->select('value', '是否启用')->options([1 => '启用', 2 => '关闭']);
                })
                ->required();
            $form->text('description')->required();
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Setting(), function (Grid $grid) {
            // Fields
            $grid->column('id')->sortable();
            $grid->column('name')->sortable()->editable();
            $grid->column('description')->limit(14, '...');
            $grid->column('type')->using(SettingModel::$TypeEnum)->sortable()->label();
            $grid->column('key')->limit(20, '...')->sortable()->copyable();
            $grid->column('value')
                ->if(function ($column) {
                    return $this->type === 'BOOLEAN';
                })
                ->then(function (Grid\Column $column) {
                    $column->bool(['1' => true, '0' => false]);
                });

            $grid->column('created_at')->sortable()->view('datetime');
            $grid->column('updated_at')->sortable()->view('datetime');

            // Functions
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name');
                $filter->like('key');
                $filter->like('value');
            });
            $grid->quickSearch(['id', 'name', 'key', 'description']);

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
        return Show::make($id, new Setting(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('key');
            $show->field('value');

            $show->field('created_at')->view('datetime');
            $show->field('updated_at')->view('datetime');
        });
    }
}

<?php

namespace App\Admin\Controllers\Out;

use App\Admin\Models\Out\WorkCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WorkCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '成功案例栏目';
    protected $description = [
              'index'  => '分类',
        //        'show'   => 'Show',
        //        'edit'   => 'Edit',
        //        'create' => 'Create',
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WorkCategory());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('image', __('Image'))->image();
        $grid->column('name', __('名称'));
        $grid->column('sort_order', __('Sort order'))->sortable()->editable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(WorkCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('名称'));
        $show->field('image', __('Image'))->image();
        $show->field('sort_order', __('Sort order'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WorkCategory());

        $form->text('name', __('名称'))->rules('required');
        $form->image('image', __('Image'))->rules('required');
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

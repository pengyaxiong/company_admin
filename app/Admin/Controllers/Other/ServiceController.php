<?php

namespace App\Admin\Controllers\Other;

use App\Admin\Models\Other\Service;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ServiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '服务优势';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Service());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Title'));
        $grid->column('en', __('En'));
        $grid->column('cn', __('Cn'));
        $grid->column('image', __('Image'))->image();
        $grid->column('des', __('Des'))->hide();
        $grid->column('info', __('Info'));
        $grid->column('sort_order', __('Sort order'));
        $grid->column('image_text', __('Image text'))->hide();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'))->hide();

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
        $show = new Show(Service::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('en', __('En'));
        $show->field('cn', __('Cn'));
        $show->field('image', __('Image'))->image();
        $show->field('des', __('Des'))->as(function ($status) {

            return json_encode($status);
        });
        $show->field('info', __('Info'));
        $show->field('sort_order', __('Sort order'));
        $show->field('image_text', __('Image text'))->as(function ($status) {

            return json_encode($status);
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Service());

        $form->text('title', __('Title'))->rules('required');
        $form->text('en', __('En'))->rules('required');
        $form->text('cn', __('Cn'))->rules('required');
        $form->image('image', __('Image'))->rules('required|image');
        $form->table('des', __('Des'), function ($table) {
            $table->text('info',__('列表'));
        })->rules('required');
        $form->textarea('info', __('Info'))->rules('required');
        $form->number('sort_order', __('Sort order'))->default(99);
        $form->table('image_text', __('Image text'), function ($table) {
            $table->text('title',__('Title'));
            $table->text('info',__('Info'));
            $table->image('image',__('Image'));
        })->rules('required');

        return $form;
    }
}

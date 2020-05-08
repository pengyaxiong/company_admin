<?php

namespace App\Admin\Controllers\Other;

use App\Admin\Models\Other\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '轮播图';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Title'));
        $grid->column('image', __('Image'))->image();
        $grid->column('info', __('Info'));
        $grid->column('sort_order', __('Sort order'))->sortable()->help('按数字从小到大排序');
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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('image', __('Image'))->image();
        $show->field('info', __('Info'));
        $show->field('sort_order', __('Sort order'));
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
        $form = new Form(new Banner());

        $form->text('title', __('Title'))->rules('required');
        $form->image('image', __('Image'))->rules('required|image');
        $form->text('info', __('Info'))->rules('required');
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

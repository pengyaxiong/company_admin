<?php

namespace App\Admin\Controllers;

use App\Admin\Models\About\Contact;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '联系我们';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Contact());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('公司名称'));
        $grid->column('phone', __('手机号'));
        $grid->column('tel', __('座机号'));
        $grid->column('email', __('邮箱'));
        $grid->column('address', __('联系地址'));

        //禁用创建按钮
        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableView();
          //  $actions->disableEdit();
            $actions->disableDelete();
        });

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
        $show = new Show(Contact::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('公司名称'));
        $show->field('phone', __('手机号'));
        $show->field('tel', __('座机号'));
        $show->field('email', __('邮箱'));
        $show->field('address', __('联系地址'));
        $show->field('weixin', __('微信二维码'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Contact());

        $form->text('name', '公司名称')->rules('required');
        $form->text('phone', '手机号')->rules('required');
        $form->text('tel', '座机号')->rules('required');
        $form->text('email', '邮箱')->rules('required|email');
        $form->text('address', '联系地址')->rules('required');
        $form->image('weixin', '微信二维码')->rules('required|image');

        return $form;
    }
}

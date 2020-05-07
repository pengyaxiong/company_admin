<?php

namespace App\Admin\Controllers;

use App\Admin\Models\About\Join;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class JoinController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '加盟代理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Join());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('姓名'));
        $grid->column('phone', __('联系方式'));
        $grid->column('company', __('公司名称'));
        $grid->column('remark', __('备注'));

        //禁用创建按钮
        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
         //   $actions->disableView();
             $actions->disableEdit();
             $actions->disableDelete();
        });

        $grid->filter(function ($filter) {
            $filter->like('name', '姓名');
            $filter->like('phone', '联系方式');
            $filter->like('company', '公司名称');
            $filter->between('created_at', '发布日期')->date();
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
        $show = new Show(Join::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('姓名'));
        $show->field('phone', __('联系方式'));
        $show->field('company', __('公式名称'));
        $show->field('remark', __('备注'));


        $show->panel()->tools(function ($tools){
            $tools->disableEdit();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Join());



        return $form;
    }
}

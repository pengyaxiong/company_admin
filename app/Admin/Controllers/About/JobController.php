<?php

namespace App\Admin\Controllers\About;

use App\Admin\Models\About\Job;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class JobController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '人才招聘';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Job());

        $grid->id('ID')->sortable();
        $grid->name('职位');
        $grid->responsibility('岗位职责')->hide();
        $grid->requirement('岗位要求')->hide();
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', __('Is show'))->switch($states);
        $grid->sort_order('排序')->sortable();

        $grid->actions(function ($actions) {
            $actions->disableView();
//            $actions->disableEdit();
//            $actions->disableDelete();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
//                $batch->disableDelete();
            });
        });

        $grid->filter(function ($filter) {
            $filter->like('name', '职位');
            $filter->between('created_at', '发布日期')->date();
            $status_text = [
                1 => '显示',
                0 => '不显示'
            ];
            $filter->equal('is_show','是否显示')->select($status_text);
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
        $show = new Show(Job::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Job());

        $form->text('name', '职位')->rules('required');
        //百度编辑器
        $form->ueditor('responsibility', '岗位职责')->rules('required');
        //百度编辑器
        $form->ueditor('requirement', '岗位要求')->rules('required');

        $states = [
            'on'  => ['value' => 1, 'text' => '显示', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '不显示', 'color' => 'danger'],
        ];

        $form->switch('is_show','是否显示')->states($states)->default(1);

        $form->number('sort_order', '排序')->rules('required')->default(99);

        return $form;
    }
}

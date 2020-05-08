<?php

namespace App\Admin\Controllers\Out;

use App\Admin\Models\Out\Hospital;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HospitalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '海外医院';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hospital());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('名称'));
        $grid->column('leave', __('Leave'))->label();
        $grid->column('image', __('Image'))->image();
        $grid->column('address', __('Address'));
        $grid->column('tel', __('Tel'));
        $grid->column('type', __('Type'))->pluck('name')->implode(',');
        $grid->column('info', __('Info'));
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', __('Is show'))->switch($states);
        $grid->column('sort_order', __('Sort order'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter) {
            $filter->like('name', __('名称'));
            $filter->between('created_at', __('Created at'))->date();
            $status_show = [
                1 => '显示',
                0 => '不显示'
            ];
            $filter->equal('is_show', __('Is show'))->select($status_show);
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
        $show = new Show(Hospital::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('名称'));
        $show->field('leave', __('Leave'));
        $show->field('image', __('Image'))->image();
        $show->field('banner', __('Banner'))->image();
        $show->field('address', __('Address'));
        $show->field('tel', __('Tel'));
        $show->field('type', __('Type'))->as(function ($status) {

            return json_encode($status);
        });
        $show->field('info', __('Info'));
        $show->field('is_show', __('Is show'))->as(function ($status) {
            if ($status == 1) {
                $status = '显示';
            } else {
                $status = '不显示';
            }
            return $status;
        });
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
        $form = new Form(new Hospital());

        $form->text('name', __('名称'))->rules('required');
        $form->text('leave', __('Leave'))->rules('required');
        $form->image('image', __('Image'))->rules('required|image');
        $form->image('banner', __('Banner'))->rules('required|image');
        $form->text('address', __('Address'))->rules('required');
        $form->mobile('tel', __('Tel'))->rules('required');
        $form->table('type', __('Type'), function ($table) {
            $table->text('name',__('Type'));
        })->rules('required');

        $form->textarea('info', __('Info'))->rules('required');
        $form->switch('is_show', __('Is show'))->default(1);
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

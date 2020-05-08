<?php

namespace App\Admin\Controllers\Out;

use App\Admin\Models\Out\Doctor;
use App\Admin\Models\Out\Hospital;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DoctorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '名医荟萃';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Doctor());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('job', __('Job'));
        $grid->column('hospital.name', __('Hospital id'));
        $grid->column('image', __('Image'))->image();
        $grid->column('type', __('Type'))->pluck('name')->implode(',');
        $grid->column('description', __('Description'))->hide();
        $grid->column('info', __('Info'))->hide();
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', __('Is show'))->switch($states);
        $grid->column('is_recommend', __('Is recommend'))->switch($states);
        $grid->column('sort_order', __('Sort order'));
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

        $grid->filter(function ($filter) {
            $filter->like('name', __('名称'));
            $filter->between('created_at', __('Created at'))->date();
            $status_show = [
                1 => '显示',
                0 => '不显示'
            ];
            $filter->equal('is_show', __('Is show'))->select($status_show);
            $status_recommend = [
                1 => '显示',
                0 => '不显示'
            ];
            $filter->equal('is_recommend', __('Is recommend'))->select($status_recommend);
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
        $show = new Show(Doctor::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('job', __('Job'));
        $show->field('hospital.name', __('Hospital id'));
        $show->field('image', __('Image'));
        $show->field('type', __('Type'))->as(function ($status) {

            return json_encode($status);
        });
        $show->field('description', __('Description'));
        $show->field('info', __('Info'));
        $show->field('is_show', __('Is show'))->as(function ($status) {
            if ($status == 1) {
                $status = '显示';
            } else {
                $status = '不显示';
            }
            return $status;
        });
        $show->field('is_recommend', __('Is recommend'))->as(function ($status) {
            if ($status == 1) {
                $status = '是';
            } else {
                $status = '不是';
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
        $form = new Form(new Doctor());

        $form->text('name', __('Name'))->rules('required');
        $form->text('job', __('Job'))->rules('required');

        $hospitals=Hospital::where('is_show',true)->get()->toArray();
        $select_hospital=array_column($hospitals, 'name', 'id');
        //创建select
        $form->select('hospital_id', __('Hospital id'))->options($select_hospital)->rules('required');

        $form->image('image', __('Image'))->rules('required');

        $form->table('type', __('Type'), function ($table) {
            $table->text('name',__('Type'));
        })->rules('required');
        $form->ueditor('description', __('Description'))->rules('required');
        $form->textarea('info', __('Info'))->rules('required');
        $form->switch('is_show', __('Is show'))->default(1);
        $form->switch('is_recommend', __('Is recommend'));
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

<?php

namespace App\Admin\Controllers\Cms;

use App\Admin\Models\Cms\Information;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InformationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '今日资讯';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Information());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('标题'));
        $grid->column('author', __('作者'));
        $grid->column('from', __('来源'));
        $grid->column('is_show', '是否显示')->display(function ($status) {
            $status_text = [
                1 => '显示',
                0 => '不显示',
            ];
            return $status_text[$status];
        });
        $grid->column('sort_order', __('排序'))->sortable();
        $grid->column('created_at', __('发布日期'));

        $grid->filter(function ($filter) {
            $filter->like('title', '标题');
            $filter->between('created_at', '发布日期')->date();
            $status_text = [
                1 => '显示',
                0 => '不显示'
            ];
            $filter->equal('is_show', '是否显示')->select($status_text);
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
        $show = new Show(Information::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('标题'));
        $show->field('author', __('作者'));
        $show->field('from', __('来源'));

        $show->field('image', __('缩略图'))->image();

        $show->field('description', __('详情'));

        $show->field('info', __('简介'));
        $show->field('see_num', __('阅读量'));
        $show->field('is_show', __('是否显示'))->as(function ($status) {
            if ($status == 1) {
                $status = '显示';
            } else {
                $status = '不显示';
            }
            return $status;
        });
        $show->field('sort_order', __('排序'));
        $show->field('created_at', __('发布日期'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Information());

        $form->text('title', __('标题'))->rules('required');
        $form->text('author', __('作者'))->rules('required');
        $form->text('from', __('来源'))->rules('required');

        $form->datetime('created_at', '发布日期')->format('YYYY-MM-DD HH:mm:ss')->rules('required');

        $form->image('image', __('缩略图'))->rules('required|image');
        $form->ueditor('description', '详情')->rules('required');
        $form->textarea('info', __('简介'));

        $form->number('see_num', __('阅读量'))->default(99);

        $states = [
            'on' => ['value' => 1, 'text' => '显示', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '不显示', 'color' => 'danger'],
        ];

        $form->switch('is_show', '是否显示')->states($states)->default(1);

        $form->number('sort_order', '排序')->rules('required')->default(99);

        return $form;
    }
}

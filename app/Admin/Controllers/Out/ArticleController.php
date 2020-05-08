<?php

namespace App\Admin\Controllers\Out;

use App\Admin\Models\Out\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '试管套餐';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Title'));
        $grid->column('author', __('Author'));
        $grid->column('from', __('From'));
        $grid->column('image', __('Image'))->image();
        $grid->column('description', __('Description'))->hide();
        $grid->column('info', __('Info'))->hide();
        $grid->column('see_num', __('See num'));
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', __('Is show'))->switch($states);
        $grid->column('is_recommend', __('Is recommend'))->switch($states);
        $grid->column('sort_order', __('Sort order'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'))->hide();

        $grid->filter(function ($filter) {
            $filter->like('title', __('Title'));
            $filter->between('created_at', __('Created at'))->date();
            $status_show = [
                1 => '显示',
                0 => '不显示'
            ];
            $filter->equal('is_show', __('Is show'))->select($status_show);
            $status_hot = [
                1 => '是',
                0 => '不是'
            ];
            $filter->equal('is_recommend', __('Is recommend'))->select($status_hot);

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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('author', __('Author'));
        $show->field('from', __('From'));
        $show->field('image', __('Image'))->image();
        $show->field('description', __('Description'));
        $show->field('info', __('Info'));
        $show->field('see_num', __('See num'));
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
        $form = new Form(new Article());


        $form->text('title', __('Title'))->rules('required');
        $form->text('author', __('Author'))->rules('required');
        $form->text('from', __('From'))->rules('required');
        $form->datetime('created_at', __('Created at'))->format('YYYY-MM-DD HH:mm:ss')->rules('required');
        $form->image('image', __('Image'))->rules('required|image');
        $form->ueditor('description', __('Description'))->rules('required');
        $form->textarea('info', __('Info'))->rules('required');
        $form->number('see_num', __('See num'))->default(99);

        $states = [
            'on' => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];

        $form->switch('is_show', __('Is show'))->states($states)->default(1);
        $form->switch('is_recommend', __('Is recommend'))->states($states);
        $form->number('sort_order', __('Sort order'))->default(99);
        return $form;
    }
}

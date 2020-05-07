<?php

namespace App\Admin\Controllers;

use App\Admin\Models\About\Article;
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
    protected $title = '新闻资讯';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'));
        $grid->column('from', __('来源'));
        $grid->column('author', __('作者'));
        $grid->column('created_at', __('创建时间'));

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
        $show->field('title', __('标题'));
        $show->field('from', __('来源'));
        $show->field('image', __('缩略图'));
        $show->field('author', __('作者'));
        $show->field('see_num', __('阅读量'));
        $show->field('created_at', __('创建时间'));
        $show->field('description', __('详情'));

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

        $form->text('title', '标题')->rules('required');
        $form->text('from', '来源')->rules('required');
        $form->text('author', '作者')->rules('required');

        $form->datetime('created_at', '创建时间')->format('YYYY-MM-DD HH:mm:ss')->rules('required');

        $form->number('see_num', '阅读量')->rules('required')->default(99);

        $form->image('image', '缩略图')->rules('required|image');

        $form->ueditor('description', '详情')->rules('required');

        $states = [
            'on'  => ['value' => 1, 'text' => '显示', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '不显示', 'color' => 'danger'],
        ];

        $form->switch('is_show','是否显示')->states($states)->default(1);


        $form->number('sort_order', '排序')->rules('required')->default(99);


        return $form;
    }
}

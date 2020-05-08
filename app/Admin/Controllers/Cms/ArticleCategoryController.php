<?php

namespace App\Admin\Controllers\Cms;

use App\Admin\Models\Cms\ArticleCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '试管专题栏目';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleCategory());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('名称'));
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', __('Is show'))->switch($states);
        $grid->column('sort_order', __('排序'))->sortable();
        $grid->filter(function ($filter) {
            $filter->like('name', '名称');
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
        $show = new Show(ArticleCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('名称'));
        $show->field('is_show', __('是否显示'));
        $show->field('sort_order', __('排序'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ArticleCategory());

        $form->text('name', __('名称'));
        $states = [
            'on' => ['value' => 1, 'text' => '显示', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '不显示', 'color' => 'danger'],
        ];

        $form->switch('is_show', '是否显示')->states($states)->default(1);

        $form->number('sort_order', '排序')->rules('required')->default(99);
        return $form;
    }
}

<?php

namespace App\Admin\Controllers\Cms;

use App\Admin\Models\Cms\Know;
use App\Admin\Models\Cms\KnowCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KnowController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '知识百科文章';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Know());

        $grid->column('id', __('Id'));
        $grid->column('category.name', __('分类'));
        $grid->column('title', __('标题'));
        $grid->column('author', __('作者'));
        $grid->column('from', __('来源'));
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', __('Is show'))->switch($states);
        $grid->column('is_recommend', __('Is recommend'))->switch($states);
        $grid->column('is_new', __('Is new'))->switch($states);
        $grid->column('is_hot', __('Is hot'))->switch($states);

        $grid->column('sort_order', __('排序'))->sortable();
        $grid->column('created_at', __('发布日期'));


        $grid->filter(function ($filter) {
            $filter->like('title', '标题');
            $filter->between('created_at', '发布日期')->date();
            $status_show = [
                1 => '显示',
                0 => '不显示'
            ];
            $filter->equal('is_show', '是否显示')->select($status_show);
            $status_hot = [
                1 => '是',
                0 => '不是'
            ];
            $filter->equal('is_hot', '是否热门')->select($status_hot);
            $status_new = [
                1 => '是',
                0 => '不是'
            ];
            $filter->equal('is_new', '是否最新')->select($status_new);
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
        $show = new Show(Know::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('分类'))->as(function ($category) {
            return KnowCategory::find($category)?KnowCategory::find($category)->name:'';
        });
        $show->field('title', __('标题'));
        $show->field('author', __('作者'));
        $show->field('from', __('来源'));
        $show->field('image', __('缩略图'))->image();
        $show->field('description', __('详情'));
        $show->field('info', __('简介'));
        $show->field('see_num', __('阅读量'));
        $show->field('is_show', __('是否显示'));
        $show->field('is_hot', __('是否热门'));
        $show->field('is_new', __('是否最新'));
        $show->field( 'is_recommend',__('Is recommend'));
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
        $form = new Form(new Know());


        $categories=KnowCategory::where('is_show', true)->where("parent_id",'>', 0)->get()->toArray();

        $select_array=array_column($categories, 'name', 'id');
        //创建select
        $form->select('category_id', '分类')->options($select_array);

        $form->text('title', __('标题'))->rules('required');
        $form->text('author', __('作者'))->rules('required');
        $form->text('from', __('来源'))->rules('required');
        $form->image('image', __('缩略图'))->rules('required|image');
        $form->ueditor('description', '详情')->rules('required');
        $form->textarea('info', __('简介'));

        $form->number('see_num', __('阅读量'))->default(99);

        $states = [
            'on' => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];

        $form->switch('is_show', '是否显示')->states($states)->default(1);
        $form->switch('is_hot', '是否热门')->states($states)->default(1);
        $form->switch('is_new', '是否最新')->states($states)->default(1);
        $form->switch('is_recommend',__('Is recommend'))->states($states)->default(1);

        $form->number('sort_order', '排序')->rules('required')->default(99);

        return $form;
    }
}

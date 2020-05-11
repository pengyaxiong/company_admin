<?php

namespace App\Admin\Controllers\Cms;

use App\Admin\Models\Cms\Ads;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '广告管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Ads());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Title'));
        // 设置text、color、和存储值
        $types = [
            'on'  => ['value' => 1, 'text' => 'PC'],
            'off' => ['value' => 0, 'text' => '移动', 'color' => 'success'],
        ];
        $grid->column('type', __('Type'))->switch($types);
        $grid->column('image', __('Image'))->image();
        $grid->column('url', __('Url'))->link();
        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', __('Is show'))->switch($states);
        $grid->column('sort_order', __('Sort order'))->sortable()->editable();
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

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
        $show = new Show(Ads::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('type', __('Type'))->as(function ($status) {
            if ($status == 1) {
                $status = 'PC';
            } else {
                $status = '移动';
            }
            return $status;
        });
        $show->field('image', __('Image'))->image();
        $show->field('url', __('Url'));
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
        $form = new Form(new Ads());

        $form->text('title', __('Title'));
        // 设置text、color、和存储值
        $types = [
            'on'  => ['value' => 1, 'text' => 'PC'],
            'off' => ['value' => 0, 'text' => '移动', 'color' => 'success'],
        ];
        $form->switch('type', __('Type'))->states($types)->default(1);
        $form->image('image', __('Image'));
        $form->url('url', __('Url'));
        $form->switch('is_show', __('Is show'))->default(1);
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

<?php

namespace App\Admin\Controllers\About;

use App\Admin\Models\About\Contact;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '联系我们';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Contact());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('公司名称'))->display(function () {
            return "<a href=".$this->host." target='_blank'>$this->name</a>";
        });
        $grid->column('host', __('Host'))->link();
        $grid->column('phone', __('手机号'));
        $grid->column('tel', __('座机号'));
        $grid->column('email', __('邮箱'));
        $grid->column('address', __('联系地址'));

        //禁用创建按钮
        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableView();
          //  $actions->disableEdit();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
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
        $show = new Show(Contact::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('公司名称'));
        $show->field('host', __('Host'));
        $show->field('phone', __('手机号'));
        $show->field('tel', __('座机号'));
        $show->field('email', __('邮箱'));
        $show->field('address', __('联系地址'));
        $show->field('bweixin', __('华孕宝微信二维码'));
        $show->field('tweixin', __('华孕堂微信二维码'));

        $show->field('地图')->latlong('lat', 'lng', $height = 400, $zoom = 16);

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Contact());

        $form->text('name', '公司名称')->rules('required');
        $form->url('host', __('Host'))->rules('required');
        $form->text('phone', '手机号')->rules('required');
        $form->text('tel', '座机号')->rules('required');
        $form->text('email', '邮箱')->rules('required|email');
        $form->text('address', '联系地址')->rules('required');
        $form->text('copyright', __('版权信息'))->rules('required');
        $form->image('bweixin', '华孕宝微信二维码')->rules('required|image');
        $form->image('tweixin', '华孕堂微信二维码')->rules('required|image');
        $form->text('url', '华孕堂网址')->rules('required');

        $form->latlong('lat', 'lng', '地图')->default(['lat' => 114.3679, 'lng' => 30.5214]);

        //表单bottom
        // $form->disableReset();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->disableCreatingCheck();

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        return $form;
    }
}

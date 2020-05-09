<?php

namespace App\Admin\Controllers\Cms;

use App\Admin\Models\Cms\KnowCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class KnowCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '知识百科栏目';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new KnowCategory());

        // 添加默认查询条件
        $grid->model()->where('parent_id',0);

        $grid->column('id', __('Id'));

        $grid->column('parent_id', '下级')->display(function () {
            return '下级';
        })->modal('下级',function ($model) {

            //echo json_encode($model->children);exit();

            $children = $model->children->map(function ($child) {
                return $child->only(['id','is_show','name']);
            });

            $array=$children->toArray();
            foreach ($array as $k=>$v){
                $url=route('cms.know-categories.edit',$v['id']);
                $array[$k]['edit']='<div class="btn">
              <a class="btn btn-sm btn-default pull-right" target="_blank" href="'.$url.'" rel="external" >
              <i class="fa fa-edit"></i> 编辑</a>
                 </div>';
            }
            
            return new Table(['ID',__('Is show'), __('名称'),'操作'], $array);
        });


        $grid->column('name', __('名称'));

        // 设置text、color、和存储值
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $grid->column('is_show', '是否显示')->switch($states);

        $grid->column('sort_order', __('Sort order'))->sortable();

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
        $show = new Show(KnowCategory::findOrFail($id));

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
        $form = new Form(new KnowCategory());

        $form->text('name', __('名称'));
        $parents = KnowCategory::get_parents();
        $parents = array_prepend($parents, ['parent_id' => 0, 'name' => '顶级']);

        $host = explode('/', \Route::getFacadeRoot()->current()->uri);
        if (!empty($host[4]) && $host[4] == 'edit') {
            $id = request()->route()->parameters()['know_category'];

            foreach ($parents as $k => $parent) {
                if (isset($parent['id']) && $parent['id'] == $id) {
                    unset($parents[$k]);
                }
            }
        }

        $form->select('parent_id', '类别')->options(
            array_column($parents, 'name', 'id')
        )->default(0);

        $states = [
            'on' => ['value' => 1, 'text' => '显示', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '不显示', 'color' => 'danger'],
        ];

        $form->switch('is_show', '是否显示')->states($states)->default(1);

        $form->number('sort_order', '排序')->rules('required')->default(99);
        return $form;

    }
}

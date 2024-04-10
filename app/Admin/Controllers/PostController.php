<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Prefecture;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('user.name', __('User Name'))->sortable();
        $grid->column('prefecture.name', __('Prefecture Name'))->sortable();
        $grid->column('city', __('City'));
        $grid->column('shop_name', __('Shop name'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('image', __('Image'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('shop_name', '店舗名');
            $filter->like('user.name', 'ユーザー名');
            $filter->between('created_at', '投稿日')->datetime();
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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User Name'));
        $show->field('prefecture.name', __('Prefecture Name'));
        $show->field('city', __('City'));
        $show->field('shop_name', __('Shop name'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('image', __('Image'))->image();
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
        $form = new Form(new Post());

        $form->select('user_id', __('User Name'))->options(User::all()->pluck('name', 'id'));
        $form->select('prefecture_id', __('Prefecture Name'))->options(Prefecture::all()->pluck('name', 'id'));
        $form->text('city', __('City'));
        $form->text('shop_name', __('Shop name'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->image('image', __('image'))->name(function($file) {
            $path = Storage::disk('s3')->putFile('/photo', $file);
            return  Storage::disk('s3')->url($path);
        });
       
        return $form;
    }
}

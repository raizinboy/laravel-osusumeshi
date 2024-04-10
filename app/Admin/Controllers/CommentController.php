<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('user.name', __('User Name'));
        $grid->column('post_id', __('Post id'))->sortable();
        $grid->column('content', __('Content'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('user.name', 'ユーザー名');
            $filter->like('post_id', '投稿ID');
            $filter->between('created_at', 'コメント日')->datetime();
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
        $show = new Show(Comment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User Name'));
        $show->field('post_id', __('Post id'));
        $show->field('content', __('Content'));
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
        $form = new Form(new Comment());

        $form->select('user_id', __('User Name'))->options(User::all()->pluck('name', 'id'));
        $form->select('post_id', __('Post id'))->options(Post::all()->pluck('id','id'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}

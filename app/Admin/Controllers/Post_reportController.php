<?php

namespace App\Admin\Controllers;

use App\Models\Post_report;
use App\Models\Post;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class Post_reportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post_report';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post_report());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('user.name', __('User Name'))->sortable();
        $grid->column('post_id', __('Post id'))->sortable();
        $grid->column('email', __('Email'));
        $grid->column('category', __('Category'));
        $grid->column('content', __('Content'));
        $grid->column('handled_flag', __('Handled Flag'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('user.name', 'ユーザー名');
            $filter->like('post_id', 'Post_ID');
            $filter->between('created_at', '報告日')->datetime();
            $filter->equal('handled_flag', '対応済みフラグ')->select(['0' => '未対応' , '1' => '対応済み']);
            $filter->scope('handled_flag', '未対応')->where('handled_flag', '0');
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
        $show = new Show(Post_report::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User Name'));
        $show->field('post_id', __('Post id'));
        $show->field('email', __('Email'));
        $show->field('category', __('Category'));
        $show->field('content', __('Content'));
        $show->filed('handled_flag', __('Handled Flag'));
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
        $form = new Form(new Post_report());

        $form->select('user_id', __('User id'))->options(User::all()->pluck('name', 'id'));
        $form->select('post_id', __('Post id'))->options(Post::all()->pluck('id', 'id'));
        $form->email('email', __('Email'));
        $form->select('category', __('Category'))->options(['誹謗・中傷' => '誹謗・中傷', '店舗への嫌がらせ' => '店舗への嫌がらせ', '不適切なコンテンツ' => '不適切なコンテンツ', '不適切な画像' => '不適切な画像', 'プライバシー侵害' => 'プライバシー侵害', 'その他' => 'その他']);
        $form->textarea('content', __('Content'));
        $form->switch('handled_flag', __('Handled Flag'));

        return $form;
    }
}

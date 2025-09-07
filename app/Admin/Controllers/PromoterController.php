<?php

namespace App\Admin\Controllers;

use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;
use \App\Models\Promoter;

class PromoterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Promoter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Promoter());

        $grid->column('id', __('Id'));
        $grid->column('promoter_id', __('Promoter id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('address', __('Address'));
        $grid->column('date_of_birth', __('Date of birth'));
        $grid->column('gender', __('Gender'));
        $grid->column('emergency_contact', __('Emergency contact'));
        $grid->column('emergency_phone', __('Emergency phone'));
        $grid->column('bank_name', __('Bank name'));
        $grid->column('bank_account', __('Bank account'));
        $grid->column('tax_id', __('Tax id'));
        $grid->column('base_salary', __('Base salary'));
        $grid->column('status', __('Status'));
        $grid->column('join_date', __('Join date'));
        $grid->column('notes', __('Notes'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Promoter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('promoter_id', __('Promoter id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('address', __('Address'));
        $show->field('date_of_birth', __('Date of birth'));
        $show->field('gender', __('Gender'));
        $show->field('emergency_contact', __('Emergency contact'));
        $show->field('emergency_phone', __('Emergency phone'));
        $show->field('bank_name', __('Bank name'));
        $show->field('bank_account', __('Bank account'));
        $show->field('tax_id', __('Tax id'));
        $show->field('base_salary', __('Base salary'));
        $show->field('status', __('Status'));
        $show->field('join_date', __('Join date'));
        $show->field('notes', __('Notes'));
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
        $form = new Form(new Promoter());

        $form->text('promoter_id', __('Promoter id'));
        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->phonenumber('phone', __('Phone'));
        $form->text('address', __('Address'));
        $form->text('date_of_birth', __('Date of birth'));
        $form->text('gender', __('Gender'));
        $form->text('emergency_contact', __('Emergency contact'));
        $form->text('emergency_phone', __('Emergency phone'));
        $form->text('bank_name', __('Bank name'));
        $form->text('bank_account', __('Bank account'));
        $form->text('tax_id', __('Tax id'));
        $form->text('base_salary', __('Base salary'));
        $form->text('status', __('Status'));
        $form->text('join_date', __('Join date'));
        $form->text('notes', __('Notes'));

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;
use \App\Models\Promoter;
use \App\Models\EventJob;

class PromoterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Promoters';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Promoter());

        $grid->column('id', 'ID')->sortable();
        $grid->column('promoter_id', 'Promoter ID')->sortable();
        $grid->column('promoter_name', 'Name')->sortable();
        $grid->column('id_no', 'ID Number')->sortable();
        $grid->column('phone_no', 'Phone Number')->sortable();
        $grid->column('bank_name', 'Bank Name')->sortable();
        $grid->column('bank_branch_name', 'Bank Branch')->sortable();
        $grid->column('account_number', 'Account Number')->sortable();

        $grid->column('created_at', 'Created At')->sortable();
        $grid->column('updated_at', 'Updated At')->sortable();

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('promoter_id', 'Promoter ID');
            $filter->like('promoter_name', 'Name');
            $filter->like('id_no', 'ID Number');
            $filter->like('phone_no', 'Phone Number');
            $filter->like('bank_name', 'Bank Name');
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
        $show = new Show(Promoter::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('promoter_id', 'Promoter ID');
        $show->field('promoter_name', 'Name');
        $show->field('id_no', 'ID Number');
        $show->field('phone_no', 'Phone Number');
        $show->field('bank_name', 'Bank Name');
        $show->field('bank_branch_name', 'Bank Branch');
        $show->field('account_number', 'Account Number');
        $show->field('created_at', 'Created At');
        $show->field('updated_at', 'Updated At');

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

        $form->tab('Basic Information', function ($form) {
            $form->text('promoter_id', 'Promoter ID')
                ->required()
                ->help('Unique promoter identifier (e.g., PROM1001)');
            
            $form->text('promoter_name', 'Promoter Name')
                ->required()
                ->help('Full name of the promoter');
        });

        $form->tab('Personal Details', function ($form) {
            $form->text('id_no', 'ID Number')
                ->required()
                ->help('National Identity Card number');
            
            $form->text('phone_no', 'Phone Number')
                ->help('Contact phone number (optional)');
        });

        $form->tab('Banking Information', function ($form) {
            $form->text('bank_name', 'Bank Name')
                ->required()
                ->help('Name of the bank');
            
            $form->text('bank_branch_name', 'Bank Branch')
                ->required()
                ->help('Bank branch name');
            
            $form->text('account_number', 'Account Number')
                ->required()
                ->help('Bank account number');
        });

        return $form;
    }
}

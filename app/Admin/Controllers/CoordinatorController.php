<?php

namespace App\Admin\Controllers;

use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;
use \App\Models\Coordinator;
use \App\Models\EventJob;

class CoordinatorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Coordinators';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Coordinator());

        $grid->column('id', 'ID')->sortable();
        $grid->column('coordinator_id', 'Coordinator ID')->sortable();
        $grid->column('coordinator_name', 'Name')->sortable();
        $grid->column('nic_no', 'NIC Number')->sortable();
        $grid->column('phone_no', 'Phone Number')->sortable();
        $grid->column('bank_name', 'Bank Name')->sortable();
        $grid->column('bank_branch_name', 'Bank Branch')->sortable();
        $grid->column('account_number', 'Account Number')->sortable();

        $grid->column('created_at', 'Created At')->sortable();
        $grid->column('updated_at', 'Updated At')->sortable();

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('coordinator_id', 'Coordinator ID');
            $filter->like('coordinator_name', 'Name');
            $filter->like('nic_no', 'NIC Number');
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
        $show = new Show(Coordinator::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('coordinator_id', 'Coordinator ID');
        $show->field('coordinator_name', 'Name');
        $show->field('nic_no', 'NIC Number');
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
        $form = new Form(new Coordinator());

        $form->tab('Basic Information', function ($form) {
            $form->text('coordinator_id', 'Coordinator ID')
                ->required()
                ->help('Unique coordinator identifier (e.g., COORD1001)');
            
            $form->text('coordinator_name', 'Coordinator Name')
                ->required()
                ->help('Full name of the coordinator');
        });

        $form->tab('Personal Details', function ($form) {
            $form->text('nic_no', 'NIC Number')
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

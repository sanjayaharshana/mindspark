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
        
        // Show related event job
        $grid->column('eventJob.job_name', 'Event Job')->sortable();
        $grid->column('eventJob.job_number', 'Job Number')->sortable();

        $grid->column('created_at', 'Created At')->sortable();
        $grid->column('updated_at', 'Updated At')->sortable();

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('coordinator_id', 'Coordinator ID');
            $filter->like('coordinator_name', 'Name');
            $filter->like('nic_no', 'NIC Number');
            $filter->like('phone_no', 'Phone Number');
            $filter->like('bank_name', 'Bank Name');
            $filter->equal('event_job_id', 'Event Job')->select(EventJob::all()->pluck('job_name', 'id'));
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

        // Show related event job details
        $show->field('eventJob.job_number', 'Event Job Number');
        $show->field('eventJob.job_name', 'Event Job Name');
        $show->field('eventJob.client_name', 'Client Name');
        $show->field('eventJob.activation_start_date', 'Job Start Date')->as(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : '';
        });
        $show->field('eventJob.activation_end_date', 'Job End Date')->as(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : 'Ongoing';
        });

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

        $form->select('event_job_id', 'Event Job')
            ->options(EventJob::all()->pluck('job_name', 'id'))
            ->required()
            ->help('Select the event job this coordinator will work on');
        
        $form->text('coordinator_id', 'Coordinator ID')
            ->required()
            ->help('Unique coordinator identifier (e.g., COORD1001)');
        
        $form->text('coordinator_name', 'Coordinator Name')
            ->required()
            ->help('Full name of the coordinator');
        
        $form->text('nic_no', 'NIC Number')
            ->required()
            ->help('National Identity Card number');
        
        $form->text('phone_no', 'Phone Number')
            ->help('Contact phone number (optional)');
        
        $form->text('bank_name', 'Bank Name')
            ->help('Name of the bank (optional)');
        
        $form->text('bank_branch_name', 'Bank Branch')
            ->help('Bank branch name (optional)');
        
        $form->text('account_number', 'Account Number')
            ->help('Bank account number (optional)');

        return $form;
    }
}

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
        
        // Show related event job
        $grid->column('eventJob.job_name', 'Event Job')->sortable();
        $grid->column('eventJob.job_number', 'Job Number')->sortable();

        $grid->column('created_at', 'Created At')->sortable();
        $grid->column('updated_at', 'Updated At')->sortable();

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('promoter_id', 'Promoter ID');
            $filter->like('promoter_name', 'Name');
            $filter->like('id_no', 'ID Number');
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
        $form = new Form(new Promoter());

        $form->tab('Basic Information', function ($form) {
            $form->select('event_job_id', 'Event Job')
                ->options(EventJob::all()->pluck('job_name', 'id'))
                ->required()
                ->help('Select the event job this promoter will work on');
            
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
                ->help('Name of the bank (optional)');
            
            $form->text('bank_branch_name', 'Bank Branch')
                ->help('Bank branch name (optional)');
            
            $form->text('account_number', 'Account Number')
                ->help('Bank account number (optional)');
        });

        return $form;
    }
}

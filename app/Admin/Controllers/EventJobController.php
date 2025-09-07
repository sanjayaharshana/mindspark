<?php

namespace App\Admin\Controllers;

use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;
use \App\Models\EventJob;

class EventJobController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Event Jobs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EventJob());

        $grid->column('id', 'ID')->sortable();
        $grid->column('job_number', 'Job Number')->sortable();
        $grid->column('job_name', 'Job Name')->sortable();
        $grid->column('client_name', 'Client Name')->sortable();
        $grid->column('activation_start_date', 'Start Date')->display(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : '';
        })->sortable();
        $grid->column('activation_end_date', 'End Date')->display(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : 'Ongoing';
        })->sortable();
        $grid->column('officer_name', 'Officer Name')->sortable();
        $grid->column('reporter_officer_name', 'Reporter Officer')->sortable();
        
        // Add relationship counts
        $grid->column('promoters_count', 'Promoters')->display(function () {
            return $this->promoters()->count();
        });
        $grid->column('coordinators_count', 'Coordinators')->display(function () {
            return $this->coordinators()->count();
        });

        $grid->column('created_at', 'Created At')->sortable();
        $grid->column('updated_at', 'Updated At')->sortable();

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('job_number', 'Job Number');
            $filter->like('job_name', 'Job Name');
            $filter->like('client_name', 'Client Name');
            $filter->between('activation_start_date', 'Start Date')->date();
            $filter->between('activation_end_date', 'End Date')->date();
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
        $show = new Show(EventJob::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('job_number', 'Job Number');
        $show->field('job_name', 'Job Name');
        $show->field('client_name', 'Client Name');
        $show->field('activation_start_date', 'Start Date')->as(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : '';
        });
        $show->field('activation_end_date', 'End Date')->as(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : 'Ongoing';
        });
        $show->field('officer_name', 'Officer Name');
        $show->field('reporter_officer_name', 'Reporter Officer');
        $show->field('created_at', 'Created At');
        $show->field('updated_at', 'Updated At');

        // Show related promoters
        $show->field('promoters', 'Promoters')->as(function ($promoters) {
            return $promoters->count() . ' promoters assigned';
        });

        // Show related coordinators
        $show->field('coordinators', 'Coordinators')->as(function ($coordinators) {
            return $coordinators->count() . ' coordinators assigned';
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
        $form = new Form(new EventJob());

        $form->text('job_number', 'Job Number')
            ->required()
            ->help('Unique job identifier (e.g., EJ1001)');
        
        $form->text('job_name', 'Job Name')
            ->required()
            ->help('Name of the event job');
        
        $form->text('client_name', 'Client Name')
            ->required()
            ->help('Name of the client company');
        
        $form->date('activation_start_date', 'Start Date')
            ->required()
            ->help('When the event job starts');
        
        $form->date('activation_end_date', 'End Date')
            ->help('When the event job ends (optional for ongoing jobs)');
        
        $form->text('officer_name', 'Officer Name')
            ->required()
            ->help('Name of the responsible officer');
        
        $form->text('reporter_officer_name', 'Reporter Officer')
            ->required()
            ->help('Name of the reporting officer');

        return $form;
    }
}

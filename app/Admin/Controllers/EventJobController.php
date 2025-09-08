<?php

namespace App\Admin\Controllers;

use Qulint\Admin\Layout\Content;
use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;
use App\Admin\Actions\SalarySheetAction;
use App\Models\EventJob;
use App\Models\Client;

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
        $grid->column('job_name', 'Job Name')->sortable();
        $grid->column('client_name', 'Client Name')->sortable();
        $grid->column('activation_start_date', 'Start Date')->display(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : '';
        })->sortable();
        $grid->column('activation_end_date', 'End Date')->display(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : 'Ongoing';
        })->sortable();


        // Add relationship counts
        $grid->column('promoters_count', 'Promoters')->display(function () {
            return $this->promoters()->count();
        });
        $grid->column('coordinators_count', 'Coordinators')->display(function () {
            return $this->coordinators()->count();
        });

        $grid->column('created_at', 'Created At')->display(function (){
            // Human readable carbon date
            return $this->created_at ? $this->created_at->diffForHumans() : '';
        })->sortable();

        // Add salary sheet action
        $grid->actions(function ($actions) {
            $actions->add(new SalarySheetAction());
        });

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('job_number', 'Job Number');
            $filter->like('job_name', 'Job Name');
            $filter->equal('client_name', 'Client')->select(Client::all()->pluck('company_name', 'company_name'));
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

        // Show client details if available
        $show->field('client_info', 'Client Information')->as(function () {
            $client = Client::where('company_name', $this->client_name)->first();
            if ($client) {
                return "Contact: {$client->contact_person_name} ({$client->contact_person_designation})<br>" .
                       "Email: {$client->email}<br>" .
                       "Phone: {$client->phone_number}<br>" .
                       "Status: " . ucfirst($client->status);
            }
            return 'Client information not available';
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

        $form->tab('Basic Information', function ($form) {
            $form->text('job_number', 'Job Number')
                ->required()
                ->help('Unique job identifier (e.g., EJ1001)');

            $form->text('job_name', 'Job Name')
                ->required()
                ->help('Name of the event job');

            $form->select('client_name', 'Client')
                ->options(Client::all()->pluck('company_name', 'company_name'))
                ->required()
                ->help('Select the client company for this event job');
        });

        $form->tab('Event Details', function ($form) {
            $form->date('activation_start_date', 'Start Date')
                ->required()
                ->help('When the event job starts');

            $form->date('activation_end_date', 'End Date')
                ->help('When the event job ends (optional for ongoing jobs)');
        });

        $form->tab('Personnel', function ($form) {
            $form->text('officer_name', 'Officer Name')
                ->required()
                ->help('Name of the responsible officer');

            $form->text('reporter_officer_name', 'Reporter Officer')
                ->required()
                ->help('Name of the reporting officer');
        });

        return $form;
    }


    public function salarySheet(Content $content)
    {


        return $content
            ->title('Referrals for ')
            ->description('Detailed view of all referrals for this user')
            ->body(view('admin.salary-sheet'));
    }


}

<?php

namespace App\Admin\Controllers;

use App\Models\Campaign;
use App\Models\Customers;
use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;

class CampaignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Campaign Management';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Campaign());

        $grid->column('id', __('ID'));
        $grid->column('campaign_id', __('Campaign ID'));
        $grid->column('name', __('Campaign Name'));
        $grid->column('status', __('Status'))->badge([
            'active' => 'success',
            'inactive' => 'danger',
            'pending' => 'warning',
            'completed' => 'info',
        ]);
        $grid->column('start_date', __('Start Date'))->date();
        $grid->column('end_date', __('End Date'))->date();
        $grid->column('days', __('Duration (Days)'));
        $grid->column('customer_id', __('Customer'))->display(function($customerId) {
            $customer = \App\Models\Customers::find($customerId);
            return $customer ? $customer->name : 'N/A';
        });
        $grid->column('organizer_id', __('Organizer'))->display(function($organizerId) {
            $organizer = \App\Models\Organizer::find($organizerId);
            return $organizer ? $organizer->name : 'N/A';
        });
        $grid->column('created_at', __('Created At'))->date();

        // Add actions
        $grid->actions(function ($actions) {
            $actions->disableDelete();
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
        $show = new Show(Campaign::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('campaign_id', __('Campaign ID'));
        $show->field('name', __('Campaign Name'));
        $show->field('status', __('Status'));
        $show->field('start_date', __('Start Date'));
        $show->field('end_date', __('End Date'));
        $show->field('days', __('Duration (Days)'));
        $show->field('notes', __('Notes'));
        $show->field('customer_id', __('Customer'))->as(function($customerId) {
            $customer = \App\Models\Customers::find($customerId);
            return $customer ? $customer->name : 'N/A';
        });
        $show->field('organizer_id', __('Organizer'))->as(function($organizerId) {
            $organizer = \App\Models\Organizer::find($organizerId);
            return $organizer ? $organizer->name : 'N/A';
        });
        $show->field('created_at', __('Created At'));
        $show->field('updated_at', __('Updated At'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Campaign());

        $form->text('campaign_id', __('Campaign ID'))
            ->required()
            ->help('Enter a unique campaign identifier');

        $form->text('name', __('Campaign Name'))
            ->required()
            ->help('Enter the campaign name');

        $form->select('status', __('Status'))
            ->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
                'pending' => 'Pending',
                'completed' => 'Completed'
            ])
            ->default('pending')
            ->required();

        $form->datetime('start_date', __('Start Date'))
            ->required()
            ->help('Select the campaign start date and time');

        $form->datetime('end_date', __('End Date'))
            ->help('Select the campaign end date and time (optional)');

        $form->number('days', __('Duration (Days)'))
            ->min(1)
            ->required()
            ->help('Enter the number of days for the campaign');

        $form->textarea('notes', __('Notes'))
            ->rows(3)
            ->help('Additional notes about the campaign');

        $form->select('customer_id', __('Customer'))
            ->options(\App\Models\Customers::pluck('name', 'id'))
            ->required()
            ->help('Select the customer for this campaign');

        $form->select('organizer_id', __('Organizer'))
            ->options(\App\Models\Organizer::pluck('name', 'id'))
            ->required()
            ->help('Select the organizer for this campaign');

        // Add form events
        $form->saving(function (Form $form) {
            // Auto-generate campaign ID if not provided
            if (empty($form->campaign_id)) {
                $form->campaign_id = 'CAM-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });

        return $form;
    }
}

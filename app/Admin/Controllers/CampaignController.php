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

        // Basic Information Tab
        $form->tab('Basic Information', function ($form) {
            $form->text('campaign_id', __('Campaign ID'))
                ->required()
                ->help('Enter a unique campaign identifier or click generate button')
                ->append('<button type="button" class="btn btn-sm btn-primary" id="generateCampaignBtn">Generate ID</button>');

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

            $form->number('days', __('Duration (Days)'))
                ->min(1)
                ->required()
                ->help('Enter the number of days for the campaign');
        });

        // Schedule Tab
        $form->tab('Schedule', function ($form) {
            $form->datetime('start_date', __('Start Date'))
                ->required()
                ->help('Select the campaign start date and time');

            $form->datetime('end_date', __('End Date'))
                ->help('Select the campaign end date and time (optional)');
        });

        // Assignment Tab
        $form->tab('Assignment', function ($form) {
            $form->select('customer_id', __('Customer'))
                ->options(\App\Models\Customers::pluck('name', 'id'))
                ->required()
                ->help('Select the customer for this campaign');

            $form->select('organizer_id', __('Organizer'))
                ->options(\App\Models\Organizer::pluck('name', 'id'))
                ->required()
                ->help('Select the organizer for this campaign');
        });

        // Additional Information Tab
        $form->tab('Additional Information', function ($form) {
            $form->textarea('notes', __('Notes'))
                ->rows(5)
                ->help('Additional notes about the campaign');
        });

        // Add form events
        $form->saving(function (Form $form) {
            // Auto-generate campaign ID if not provided
            if (empty($form->campaign_id)) {
                $form->campaign_id = 'CAM-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });

        // Add JavaScript for campaign ID generation
        $form->html('<script>
            document.addEventListener("DOMContentLoaded", function() {
                var generateBtn = document.getElementById("generateCampaignBtn");
                if (generateBtn) {
                    generateBtn.addEventListener("click", function() {
                        // Get the customer select element
                        var customerSelect = document.querySelector("select[name=\'customer_id\']");
                        var customerId = customerSelect ? customerSelect.value : "1";
                        
                        // Get current date in YYYYMMDD format
                        var today = new Date();
                        var year = today.getFullYear();
                        var month = String(today.getMonth() + 1).padStart(2, "0");
                        var day = String(today.getDate()).padStart(2, "0");
                        var dateStr = year + month + day;
                        
                        // Generate campaign ID in format: customer{id}/{date}
                        var campaignId = "customer" + customerId + "/" + dateStr;
                        
                        // Set the campaign ID field value
                        var campaignIdField = document.querySelector("input[name=\'campaign_id\']");
                        if (campaignIdField) {
                            campaignIdField.value = campaignId;
                        }
                    });
                }
            });
        </script>');

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Models\Promoter;
use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;

class PromoterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Promoter Management';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Promoter());

        $grid->column('id', __('ID'));
        $grid->column('promoter_id', __('Promoter ID'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('base_salary', __('Base Salary'))->display(function($salary) {
            return '$' . number_format($salary, 2);
        });
        $grid->column('status', __('Status'))->badge([
            'active' => 'success',
            'inactive' => 'danger',
            'suspended' => 'warning',
        ]);
        $grid->column('join_date', __('Join Date'))->date();
        $grid->column('created_at', __('Created At'))->date();

        // Add actions
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

        // Add filters
        $grid->filter(function($filter) {
            $filter->like('name', 'Name');
            $filter->like('email', 'Email');
            $filter->equal('status', 'Status')->select([
                'active' => 'Active',
                'inactive' => 'Inactive',
                'suspended' => 'Suspended'
            ]);
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

        $show->field('id', __('ID'));
        $show->field('promoter_id', __('Promoter ID'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('address', __('Address'));
        $show->field('date_of_birth', __('Date of Birth'));
        $show->field('gender', __('Gender'));
        $show->field('emergency_contact', __('Emergency Contact'));
        $show->field('emergency_phone', __('Emergency Phone'));
        $show->field('bank_name', __('Bank Name'));
        $show->field('bank_account', __('Bank Account'));
        $show->field('tax_id', __('Tax ID'));
        $show->field('base_salary', __('Base Salary'));
        $show->field('status', __('Status'));
        $show->field('join_date', __('Join Date'));
        $show->field('notes', __('Notes'));
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
        $form = new Form(new Promoter());

        // Personal Information Tab
        $form->tab('Personal Information', function ($form) {
            $form->text('promoter_id', __('Promoter ID'))
                ->required()
                ->help('Enter a unique promoter identifier')
                ->append('<button type="button" class="btn btn-sm btn-primary" id="generatePromoterBtn">Generate ID</button>');

            $form->text('name', __('Full Name'))
                ->required()
                ->help('Enter the promoter\'s full name');

            $form->email('email', __('Email'))
                ->required()
                ->help('Enter the promoter\'s email address');

            $form->text('phone', __('Phone'))
                ->help('Enter the promoter\'s phone number');

            $form->textarea('address', __('Address'))
                ->rows(3)
                ->help('Enter the promoter\'s address');

            $form->date('date_of_birth', __('Date of Birth'))
                ->help('Enter the promoter\'s date of birth');

            $form->select('gender', __('Gender'))
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other'
                ])
                ->help('Select the promoter\'s gender');
        });

        // Emergency Contact Tab
        $form->tab('Emergency Contact', function ($form) {
            $form->text('emergency_contact', __('Emergency Contact Name'))
                ->help('Enter the name of emergency contact person');

            $form->text('emergency_phone', __('Emergency Contact Phone'))
                ->help('Enter the phone number of emergency contact');
        });

        // Financial Information Tab
        $form->tab('Financial Information', function ($form) {
            $form->text('bank_name', __('Bank Name'))
                ->help('Enter the bank name');

            $form->text('bank_account', __('Bank Account Number'))
                ->help('Enter the bank account number');

            $form->text('tax_id', __('Tax ID'))
                ->help('Enter the tax identification number');

            $form->currency('base_salary', __('Base Salary'))
                ->symbol('$')
                ->help('Enter the base salary amount');
        });

        // Employment Information Tab
        $form->tab('Employment Information', function ($form) {
            $form->select('status', __('Status'))
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'suspended' => 'Suspended'
                ])
                ->default('active')
                ->required();

            $form->date('join_date', __('Join Date'))
                ->help('Enter the date when promoter joined');
        });

        // Additional Information Tab
        $form->tab('Additional Information', function ($form) {
            $form->textarea('notes', __('Notes'))
                ->rows(5)
                ->help('Additional notes about the promoter');
        });

        // Add form events
        $form->saving(function (Form $form) {
            // Auto-generate promoter ID if not provided
            if (empty($form->promoter_id)) {
                $form->promoter_id = 'PROM-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });

        // Add JavaScript for promoter ID generation
        $form->html('<script>
            document.addEventListener("DOMContentLoaded", function() {
                var generateBtn = document.getElementById("generatePromoterBtn");
                if (generateBtn) {
                    generateBtn.addEventListener("click", function() {
                        // Get current date in YYYYMMDD format
                        var today = new Date();
                        var year = today.getFullYear();
                        var month = String(today.getMonth() + 1).padStart(2, "0");
                        var day = String(today.getDate()).padStart(2, "0");
                        var dateStr = year + month + day;
                        
                        // Generate random 4-digit number
                        var randomNum = Math.floor(1000 + Math.random() * 9000);
                        
                        // Generate promoter ID in format: PROM-{date}-{random}
                        var promoterId = "PROM-" + dateStr + "-" + randomNum;
                        
                        // Set the promoter ID field value
                        var promoterIdField = document.querySelector("input[name=\'promoter_id\']");
                        if (promoterIdField) {
                            promoterIdField.value = promoterId;
                        }
                    });
                }
            });
        </script>');

        return $form;
    }
}

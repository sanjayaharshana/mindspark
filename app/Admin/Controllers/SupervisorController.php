<?php

namespace App\Admin\Controllers;

use App\Models\Supervisor;
use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;

class SupervisorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Supervisor Management';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Supervisor());

        $grid->column('id', __('ID'));
        $grid->column('supervisor_id', __('Supervisor ID'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('department', __('Department'));
        $grid->column('position', __('Position'));
        $grid->column('team_size', __('Team Size'))->display(function($size) {
            return $size . ' members';
        });
        $grid->column('base_salary', __('Base Salary'))->display(function($salary) {
            return '$' . number_format($salary, 2);
        });
        $grid->column('bonus_percentage', __('Bonus %'))->display(function($bonus) {
            return $bonus . '%';
        });
        $grid->column('status', __('Status'))->badge([
            'active' => 'success',
            'inactive' => 'danger',
            'suspended' => 'warning',
            'retired' => 'secondary',
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
            $filter->like('department', 'Department');
            $filter->equal('status', 'Status')->select([
                'active' => 'Active',
                'inactive' => 'Inactive',
                'suspended' => 'Suspended',
                'retired' => 'Retired'
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
        $show = new Show(Supervisor::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('supervisor_id', __('Supervisor ID'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('address', __('Address'));
        $show->field('date_of_birth', __('Date of Birth'));
        $show->field('gender', __('Gender'));
        $show->field('emergency_contact', __('Emergency Contact'));
        $show->field('emergency_phone', __('Emergency Phone'));
        $show->field('department', __('Department'));
        $show->field('position', __('Position'));
        $show->field('employee_id', __('Employee ID'));
        $show->field('bank_name', __('Bank Name'));
        $show->field('bank_account', __('Bank Account'));
        $show->field('tax_id', __('Tax ID'));
        $show->field('base_salary', __('Base Salary'));
        $show->field('bonus_percentage', __('Bonus Percentage'));
        $show->field('status', __('Status'));
        $show->field('join_date', __('Join Date'));
        $show->field('promotion_date', __('Promotion Date'));
        $show->field('team_size', __('Team Size'));
        $show->field('responsibilities', __('Responsibilities'));
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
        $form = new Form(new Supervisor());

        // Personal Information Tab
        $form->tab('Personal Information', function ($form) {
            $form->text('supervisor_id', __('Supervisor ID'))
                ->required()
                ->help('Enter a unique supervisor identifier')
                ->append('<button type="button" class="btn btn-sm btn-primary" id="generateSupervisorBtn">Generate ID</button>');

            $form->text('name', __('Full Name'))
                ->required()
                ->help('Enter the supervisor\'s full name');

            $form->email('email', __('Email'))
                ->required()
                ->help('Enter the supervisor\'s email address');

            $form->text('phone', __('Phone'))
                ->help('Enter the supervisor\'s phone number');

            $form->textarea('address', __('Address'))
                ->rows(3)
                ->help('Enter the supervisor\'s address');

            $form->date('date_of_birth', __('Date of Birth'))
                ->help('Enter the supervisor\'s date of birth');

            $form->select('gender', __('Gender'))
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other'
                ])
                ->help('Select the supervisor\'s gender');
        });

        // Emergency Contact Tab
        $form->tab('Emergency Contact', function ($form) {
            $form->text('emergency_contact', __('Emergency Contact Name'))
                ->help('Enter the name of emergency contact person');

            $form->text('emergency_phone', __('Emergency Contact Phone'))
                ->help('Enter the phone number of emergency contact');
        });

        // Employment Information Tab
        $form->tab('Employment Information', function ($form) {
            $form->text('department', __('Department'))
                ->help('Enter the department name');

            $form->text('position', __('Position'))
                ->help('Enter the supervisor\'s position/title');

            $form->text('employee_id', __('Employee ID'))
                ->help('Enter the employee identification number');

            $form->number('team_size', __('Team Size'))
                ->min(0)
                ->help('Enter the number of team members under supervision');

            $form->textarea('responsibilities', __('Responsibilities'))
                ->rows(4)
                ->help('Enter the key responsibilities and duties');
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

            $form->number('bonus_percentage', __('Bonus Percentage'))
                ->min(0)
                ->max(100)
                ->step(0.01)
                ->help('Enter the bonus percentage (0-100)');
        });

        // Employment Status Tab
        $form->tab('Employment Status', function ($form) {
            $form->select('status', __('Status'))
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'suspended' => 'Suspended',
                    'retired' => 'Retired'
                ])
                ->default('active')
                ->required();

            $form->date('join_date', __('Join Date'))
                ->help('Enter the date when supervisor joined');

            $form->date('promotion_date', __('Promotion Date'))
                ->help('Enter the date when promoted to supervisor position');
        });

        // Additional Information Tab
        $form->tab('Additional Information', function ($form) {
            $form->textarea('notes', __('Notes'))
                ->rows(5)
                ->help('Additional notes about the supervisor');
        });

        // Add form events
        $form->saving(function (Form $form) {
            // Auto-generate supervisor ID if not provided
            if (empty($form->supervisor_id)) {
                $form->supervisor_id = 'SUP-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });

        // Add JavaScript for supervisor ID generation
        $form->html('<script>
            document.addEventListener("DOMContentLoaded", function() {
                var generateBtn = document.getElementById("generateSupervisorBtn");
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
                        
                        // Generate supervisor ID in format: SUP-{date}-{random}
                        var supervisorId = "SUP-" + dateStr + "-" + randomNum;
                        
                        // Set the supervisor ID field value
                        var supervisorIdField = document.querySelector("input[name=\'supervisor_id\']");
                        if (supervisorIdField) {
                            supervisorIdField.value = supervisorId;
                        }
                    });
                }
            });
        </script>');

        return $form;
    }
}

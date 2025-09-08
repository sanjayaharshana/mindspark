<?php

namespace App\Admin\Controllers;

use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;
use \App\Models\Client;

class ClientController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Clients';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Client());

        $grid->column('id', 'ID')->sortable();
        $grid->column('client_code', 'Client Code')->sortable();
        $grid->column('company_name', 'Company Name')->sortable();
        $grid->column('contact_person_name', 'Contact Person')->sortable();
        $grid->column('email', 'Email')->sortable();
        $grid->column('phone_number', 'Phone')->sortable();
        $grid->column('mobile_number', 'Mobile')->sortable();
        $grid->column('city', 'City')->sortable();
        $grid->column('industry', 'Industry')->sortable();
        $grid->column('client_type', 'Type')->display(function ($type) {
            return ucfirst($type);
        })->sortable();
        $grid->column('status', 'Status')->display(function ($status) {
            $badgeClass = $status === 'active' ? 'success' : ($status === 'inactive' ? 'warning' : 'danger');
            return "<span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span>";
        })->sortable();

        $grid->column('created_at', 'Created At')->sortable();
        $grid->column('updated_at', 'Updated At')->sortable();

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('client_code', 'Client Code');
            $filter->like('company_name', 'Company Name');
            $filter->like('contact_person_name', 'Contact Person');
            $filter->like('email', 'Email');
            $filter->like('city', 'City');
            $filter->like('industry', 'Industry');
            $filter->equal('client_type', 'Client Type')->select([
                'individual' => 'Individual',
                'company' => 'Company',
                'ngo' => 'NGO',
                'government' => 'Government'
            ]);
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
        $show = new Show(Client::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('client_code', 'Client Code');
        $show->field('company_name', 'Company Name');
        $show->field('contact_person_name', 'Contact Person');
        $show->field('contact_person_designation', 'Designation');
        $show->field('email', 'Email');
        $show->field('phone_number', 'Phone Number');
        $show->field('mobile_number', 'Mobile Number');
        $show->field('address', 'Address');
        $show->field('city', 'City');
        $show->field('state', 'State');
        $show->field('postal_code', 'Postal Code');
        $show->field('country', 'Country');
        $show->field('website', 'Website');
        $show->field('industry', 'Industry');
        $show->field('client_type', 'Client Type')->as(function ($type) {
            return ucfirst($type);
        });
        $show->field('status', 'Status')->as(function ($status) {
            $badgeClass = $status === 'active' ? 'success' : ($status === 'inactive' ? 'warning' : 'danger');
            return "<span class='badge badge-{$badgeClass}'>" . ucfirst($status) . "</span>";
        });
        $show->field('notes', 'Notes');
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
        $form = new Form(new Client());

        $form->tab('Basic Information', function ($form) {
            $form->text('client_code', 'Client Code')
                ->required()
                ->help('Unique client identifier (e.g., CLI1001)');
            
            $form->text('company_name', 'Company Name')
                ->required()
                ->help('Name of the client company');
            
            $form->select('client_type', 'Client Type')
                ->options([
                    'individual' => 'Individual',
                    'company' => 'Company',
                    'ngo' => 'NGO',
                    'government' => 'Government'
                ])
                ->required()
                ->help('Type of client');
            
            $form->select('status', 'Status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'suspended' => 'Suspended'
                ])
                ->required()
                ->help('Current status of the client');
        });

        $form->tab('Contact Information', function ($form) {
            $form->text('contact_person_name', 'Contact Person Name')
                ->required()
                ->help('Name of the main contact person');
            
            $form->text('contact_person_designation', 'Designation')
                ->help('Job title/designation of contact person');
            
            $form->email('email', 'Email')
                ->help('Primary email address');
            
            $form->text('phone_number', 'Phone Number')
                ->help('Office phone number');
            
            $form->text('mobile_number', 'Mobile Number')
                ->help('Mobile phone number');
            
            $form->url('website', 'Website')
                ->help('Company website URL');
        });

        $form->tab('Address Information', function ($form) {
            $form->textarea('address', 'Address')
                ->help('Full address');
            
            $form->text('city', 'City')
                ->help('City name');
            
            $form->text('state', 'State')
                ->help('State/Province');
            
            $form->text('postal_code', 'Postal Code')
                ->help('Postal/ZIP code');
            
            $form->text('country', 'Country')
                ->help('Country name');
        });

        $form->tab('Additional Information', function ($form) {
            $form->text('industry', 'Industry')
                ->help('Industry sector (e.g., Technology, Healthcare)');
            
            $form->textarea('notes', 'Notes')
                ->help('Additional notes about the client');
        });

        return $form;
    }
}

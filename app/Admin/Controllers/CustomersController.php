<?php

namespace App\Admin\Controllers;

use App\Models\Customers;
use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;

class CustomersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer Management';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customers());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('company', __('Company'));
        $grid->column('status', __('Status'))->badge([
            'active' => 'success',
            'inactive' => 'danger',
            'pending' => 'warning',
        ]);
        $grid->column('created_at', __('Created At'))->date();

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
        $show = new Show(Customers::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('address', __('Address'));
        $show->field('company', __('Company'));
        $show->field('status', __('Status'));
        $show->field('notes', __('Notes'));
        $show->field('is_company', __('Is Company'));
        $show->field('coordinators', __('Coordinators'));
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
        $form = new Form(new Customers());

        $form->text('name', __('Name'))
            ->required()
            ->help('Enter the customer name');

        $form->email('email', __('Email'))
            ->required()
            ->help('Enter the customer email address');

        $form->text('phone', __('Phone'))
            ->help('Enter the customer phone number');

        $form->textarea('address', __('Address'))
            ->rows(3)
            ->help('Enter the customer address');

        $form->text('company', __('Company'))
            ->help('Enter the company name (if applicable)');

        $form->select('status', __('Status'))
            ->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
                'pending' => 'Pending'
            ])
            ->default('active')
            ->required();

        $form->textarea('notes', __('Notes'))
            ->rows(3)
            ->help('Additional notes about the customer');

        $form->switch('is_company', __('Is Company'))
            ->default(1)
            ->help('Check if this is a company customer');

        $form->text('coordinators', __('Coordinators'))
            ->help('Enter coordinator names separated by commas');

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Models\Organizer;
use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;

class OrganizerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Organizer Management';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Organizer());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('company', __('Company'));
        $grid->column('position', __('Position'));
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
        $show = new Show(Organizer::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('company', __('Company'));
        $show->field('position', __('Position'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Organizer());

        $form->text('name', __('Name'))
            ->required()
            ->help('Enter the organizer name');

        $form->email('email', __('Email'))
            ->required()
            ->help('Enter the organizer email address');

        $form->text('phone', __('Phone'))
            ->help('Enter the organizer phone number');

        $form->text('company', __('Company'))
            ->help('Enter the company name');

        $form->text('position', __('Position'))
            ->help('Enter the organizer position/title');

        $form->select('status', __('Status'))
            ->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
                'pending' => 'Pending'
            ])
            ->default('active')
            ->required();

        return $form;
    }
}

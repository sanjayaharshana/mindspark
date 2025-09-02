<?php

namespace App\Admin\Controllers;

use App\Models\Campaign;
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
    protected $title = 'Campaign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Campaign());

        $grid->column('id', __('Id'));
        $grid->column('campaign_id', __('Campaign id'));
        $grid->column('name', __('Name'));
        $grid->column('status', __('Status'));
        $grid->column('start_date', __('Start date'));
        $grid->column('end_date', __('End date'));
        $grid->column('days', __('Days'));
        $grid->column('notes', __('Notes'));
        $grid->column('organizer_id', __('Organizer id'));
        $grid->column('customer_id', __('Customer id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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

        $show->field('id', __('Id'));
        $show->field('campaign_id', __('Campaign id'));
        $show->field('name', __('Name'));
        $show->field('status', __('Status'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
        $show->field('days', __('Days'));
        $show->field('notes', __('Notes'));
        $show->field('organizer_id', __('Organizer id'));
        $show->field('customer_id', __('Customer id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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

        $form->text('campaign_id', __('Campaign id'));
        $form->text('name', __('Name'));
        $form->text('status', __('Status'));
        $form->text('start_date', __('Start date'));
        $form->text('end_date', __('End date'));
        $form->text('days', __('Days'));
        $form->text('notes', __('Notes'));
        $form->text('organizer_id', __('Organizer id'));
        $form->text('customer_id', __('Customer id'));

        return $form;
    }
}

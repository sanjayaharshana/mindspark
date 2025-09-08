<?php

namespace App\Admin\Actions;

use Qulint\Admin\Actions\RowAction;

class SalarySheetAction extends RowAction
{
    public $name = 'Salary Sheet';
    public $icon = 'fa-money';

    /**
     * @return string
     */
    public function href()
    {
        return admin_url("event-jobs/{$this->getKey()}/salary-sheet");
    }
}


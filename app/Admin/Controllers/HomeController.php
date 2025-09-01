<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Qulint\Admin\Admin;
use Qulint\Admin\Controllers\Dashboard;
use Qulint\Admin\Layout\Column;
use Qulint\Admin\Layout\Content;
use Qulint\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->css_file(Admin::asset("qulint-admin/css/pages/dashboard.css"))
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }
}

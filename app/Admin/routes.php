<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\CoordinatorController;
use App\Admin\Controllers\EventJobController;
use App\Admin\Controllers\PromoterController;


Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('coordinators', CoordinatorController::class);
    $router->resource('event-jobs', EventJobController::class);
    $router->get('event-jobs/{id}/salary-sheet', 'EventJobController@salarySheet')->name('event-jobs.salary-sheet');
    $router->resource('promoters', PromoterController::class);
});

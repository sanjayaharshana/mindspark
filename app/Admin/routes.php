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
    $router->get('event-jobs/{id}/assign-promoters', 'EventJobController@assignPromoters')->name('event-jobs.assign-promoters');
    $router->post('event-jobs/assign-promoter', 'EventJobController@storePromoterAssignment')->name('event-jobs.store-promoter-assignment');
    $router->delete('event-jobs/remove-promoter-assignment', 'EventJobController@removePromoterAssignment')->name('event-jobs.remove-promoter-assignment');
    $router->get('event-jobs/{eventId}/available-promoters', 'EventJobController@getAvailablePromoters')->name('event-jobs.available-promoters');
    
    // Attendance routes
    $router->post('event-jobs/update-attendance', 'EventJobController@updateAttendance')->name('event-jobs.update-attendance');
    $router->get('event-jobs/{eventId}/attendance-data', 'EventJobController@getAttendanceData')->name('event-jobs.attendance-data');
    $router->post('event-jobs/mark-all-present', 'EventJobController@markAllPresent')->name('event-jobs.mark-all-present');
    
    // Test route for debugging
    $router->get('test-attendance', function() {
        try {
            $count = \App\Models\Attendance::count();
            return response()->json(['success' => true, 'count' => $count, 'message' => 'Attendance table is accessible']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    });
    
    $router->resource('promoters', PromoterController::class);
});

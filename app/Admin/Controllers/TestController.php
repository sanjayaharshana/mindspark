<?php

namespace App\Admin\Controllers;

use App\Models\EventJob;
use Illuminate\Http\Request;
use Qulint\Admin\Layout\Content;
use Qulint\Admin\Controllers\AdminController;

class TestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Test Page';

    /**
     * Test method to check if the issue is with the salary sheet view specifically
     */
    public function test($id, Content $content)
    {
        $eventJob = EventJob::findOrFail($id);

        return $content
            ->title('Test Page for ' . $eventJob->job_name)
            ->body(view('admin.test-page', compact('eventJob')));
    }
}

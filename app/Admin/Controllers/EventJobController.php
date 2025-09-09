<?php

namespace App\Admin\Controllers;

use App\Models\Promoter;
use App\Models\PromoterEventJob;
use App\Models\Coordinator;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Qulint\Admin\Layout\Content;
use Qulint\Admin\Controllers\AdminController;
use Qulint\Admin\Form;
use Qulint\Admin\Grid;
use Qulint\Admin\Show;
use App\Models\EventJob;
use App\Models\Client;

class EventJobController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Event Jobs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EventJob());

        $grid->column('id', 'ID')->sortable();
        $grid->column('job_name', 'Job Name')->sortable();
        $grid->column('client_name', 'Client Name')->sortable();
        $grid->column('activation_start_date', 'Start Date')->display(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : '';
        })->sortable();
        $grid->column('activation_end_date', 'End Date')->display(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : 'Ongoing';
        })->sortable();


        // Add relationship counts
        $grid->column('promoters_count', 'Promoters')->display(function () {
            return $this->promoters()->count();
        });
        $grid->column('coordinators_count', 'Coordinators')->display(function () {
            return $this->coordinators()->count();
        });

        $grid->column('created_at', 'Created At')->display(function (){
            // Human readable carbon date
            return $this->created_at ? $this->created_at->diffForHumans() : '';
        })->sortable();

        // Add salary sheet button column
        $grid->column('salary_sheet', 'Salary Sheet')->display(function () {
            return '<a href="' . admin_url("event-jobs/{$this->id}/salary-sheet") . '" class="btn btn-sm btn-primary">
                        <i class="fa fa-money"></i> Salary Sheet
                    </a>';
        });

        // Add test button column
        $grid->column('test', 'Test')->display(function () {
            return '<a href="' . admin_url("event-jobs/{$this->id}/test") . '" class="btn btn-sm btn-warning">
                        <i class="fa fa-test"></i> Test
                    </a>';
        });

        // Add simple salary sheet button column
        $grid->column('simple_salary', 'Simple Salary')->display(function () {
            return '<a href="' . admin_url("event-jobs/{$this->id}/salary-sheet-simple") . '" class="btn btn-sm btn-success">
                        <i class="fa fa-file"></i> Simple
                    </a>';
        });

        // Add filters
        $grid->filter(function ($filter) {
            $filter->like('job_number', 'Job Number');
            $filter->like('job_name', 'Job Name');
            $filter->equal('client_name', 'Client')->select(Client::all()->pluck('company_name', 'company_name'));
            $filter->between('activation_start_date', 'Start Date')->date();
            $filter->between('activation_end_date', 'End Date')->date();
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
        $show = new Show(EventJob::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('job_number', 'Job Number');
        $show->field('job_name', 'Job Name');
        $show->field('client_name', 'Client Name');
        $show->field('activation_start_date', 'Start Date')->as(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : '';
        });
        $show->field('activation_end_date', 'End Date')->as(function ($date) {
            return $date ? date('Y-m-d', strtotime($date)) : 'Ongoing';
        });
        $show->field('officer_name', 'Officer Name');
        $show->field('reporter_officer_name', 'Reporter Officer');
        $show->field('created_at', 'Created At');
        $show->field('updated_at', 'Updated At');

        // Show related promoters
        $show->field('promoters', 'Promoters')->as(function ($promoters) {
            return $promoters->count() . ' promoters assigned';
        });

        // Show related coordinators
        $show->field('coordinators', 'Coordinators')->as(function ($coordinators) {
            return $coordinators->count() . ' coordinators assigned';
        });

        // Show client details if available
        $show->field('client_info', 'Client Information')->as(function () {
            $client = Client::where('company_name', $this->client_name)->first();
            if ($client) {
                return "Contact: {$client->contact_person_name} ({$client->contact_person_designation})<br>" .
                       "Email: {$client->email}<br>" .
                       "Phone: {$client->phone_number}<br>" .
                       "Status: " . ucfirst($client->status);
            }
            return 'Client information not available';
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EventJob());

        $form->tab('Basic Information', function ($form) {
            $form->text('job_number', 'Job Number')
                ->required()
                ->help('Unique job identifier (e.g., EJ1001)');

            $form->text('job_name', 'Job Name')
                ->required()
                ->help('Name of the event job');

            $form->select('client_name', 'Client')
                ->options(Client::all()->pluck('company_name', 'company_name'))
                ->required()
                ->help('Select the client company for this event job');
        });

        $form->tab('Event Details', function ($form) {
            $form->date('activation_start_date', 'Start Date')
                ->required()
                ->help('When the event job starts');

            $form->date('activation_end_date', 'End Date')
                ->help('When the event job ends (optional for ongoing jobs)');
        });

        $form->tab('Personnel', function ($form) {
            $form->text('officer_name', 'Officer Name')
                ->required()
                ->help('Name of the responsible officer');

            $form->text('reporter_officer_name', 'Reporter Officer')
                ->required()
                ->help('Name of the reporting officer');
        });

        return $form;
    }


    public function salarySheet($id,Content $content)
    {
        $eventJob = EventJob::findOrFail($id);
        $assignedPromoters = $eventJob->assignedPromoters()->with(['promoter', 'coordinator'])->get();

        // Load attendance data if event has dates set
        $attendanceData = [];
        $eventDates = [];
        
        if ($eventJob->activation_start_date && $eventJob->activation_end_date) {
            $attendanceData = Attendance::getAttendanceForEvent(
                $eventJob->id,
                $eventJob->activation_start_date,
                $eventJob->activation_end_date
            );
            
            // Generate array of all event dates for the table headers
            $startDate = \Carbon\Carbon::parse($eventJob->activation_start_date);
            $endDate = \Carbon\Carbon::parse($eventJob->activation_end_date);
            
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                $eventDates[] = $currentDate->format('Y-m-d');
                $currentDate->addDay();
            }
        }

        return $content
            ->title('Salary Sheet for '. $eventJob->job_name)
            ->body(view('admin.salary-sheet',[
                'eventJob' => $eventJob,
                'assignedPromoters' => $assignedPromoters,
                'attendanceData' => $attendanceData,
                'eventDates' => $eventDates
            ]));
    }

    public function salarySheetSimple($id, Content $content)
    {
        $eventJob = EventJob::findOrFail($id);
        $assignedPromoters = $eventJob->assignedPromoters()->with(['promoter', 'coordinator'])->get();

        return $content
            ->title('Salary Sheet - ' . $eventJob->job_name)
            ->body(view('admin.salary-sheet-simple', compact('eventJob', 'assignedPromoters')));
    }

    /**
     * Show promoter assignment form
     */
    public function assignPromoters($id, Content $content)
    {
        $eventJob = EventJob::findOrFail($id);
        $availablePromoters = Promoter::all();

        $supervisors = Coordinator::all();
        $assignedPromoters = $eventJob->assignedPromoters()->with(['promoter', 'coordinator'])->get();

        return $content
            ->title('Assign Promoters to ' . $eventJob->job_name)
            ->body(view('admin.assign-promoters', compact('eventJob', 'availablePromoters', 'supervisors', 'assignedPromoters')));
    }

    /**
     * Store promoter assignment
     */
    public function storePromoterAssignment(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:event_jobs,id',
            'promoter_id' => 'required|exists:promoters,id',
            'supervisor_id' => 'required|exists:coordinators,id',
            'supervisor_commission' => 'required|numeric|min:0',
            'promoter_salary_per_day' => 'required|numeric|min:0',
        ]);

        // Check if promoter is already assigned to this event
        $existingAssignment = PromoterEventJob::where('promoter_id', $request->promoter_id)
            ->where('event_id', $request->event_id)
            ->first();

        if ($existingAssignment) {
            return response()->json(['error' => 'This promoter is already assigned to this event job.'], 400);
        }

        PromoterEventJob::create($request->all());

        return response()->json(['success' => 'Promoter assigned successfully!']);
    }

    /**
     * Remove promoter assignment
     */
    public function removePromoterAssignment(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:promoters_for_event_job,id',
        ]);

        PromoterEventJob::findOrFail($request->assignment_id)->delete();

        return response()->json(['success' => 'Promoter assignment removed successfully!']);
    }

    /**
     * Get available promoters for assignment
     */
    public function getAvailablePromoters($eventId)
    {
        $availablePromoters = Promoter::whereNotIn('id', function($query) use ($eventId) {
            $query->select('promoter_id')
                  ->from('promoters_for_event_job')
                  ->where('event_id', $eventId);
        })->get();

        return response()->json($availablePromoters);
    }

    /**
     * Update attendance for a promoter
     */
    public function updateAttendance(Request $request)
    {
        try {
            $request->validate([
                'promoter_id' => 'required|exists:promoters,id',
                'event_id' => 'required|exists:event_jobs,id',
                'date' => 'required|date',
                'status' => 'required|in:attend,absent',
            ]);

            $attendance = Attendance::markAttendance(
                $request->promoter_id,
                $request->event_id,
                $request->date,
                $request->status
            );

            return response()->json([
                'success' => true,
                'message' => 'Attendance updated successfully',
                'attendance' => $attendance
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating attendance: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get attendance data for an event
     */
    public function getAttendanceData($eventId)
    {
        $eventJob = EventJob::findOrFail($eventId);

        if (!$eventJob->activation_start_date || !$eventJob->activation_end_date) {
            return response()->json([
                'success' => false,
                'message' => 'Event dates not set'
            ]);
        }

        $attendanceData = Attendance::getAttendanceForEvent(
            $eventId,
            $eventJob->activation_start_date,
            $eventJob->activation_end_date
        );

        return response()->json([
            'success' => true,
            'attendance_data' => $attendanceData,
            'event_dates' => [
                'start_date' => $eventJob->activation_start_date->format('Y-m-d'),
                'end_date' => $eventJob->activation_end_date->format('Y-m-d'),
            ]
        ]);
    }

    /**
     * Mark all promoters present for a specific date
     */
    public function markAllPresent(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:event_jobs,id',
            'date' => 'required|date',
        ]);

        $assignedPromoters = PromoterEventJob::where('event_id', $request->event_id)->get();

        foreach ($assignedPromoters as $assignment) {
            Attendance::markAttendance(
                $assignment->promoter_id,
                $request->event_id,
                $request->date,
                'attend'
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'All promoters marked as present for ' . $request->date
        ]);
    }

    /**
     * Bulk update attendance for multiple promoters and dates
     */
    public function bulkUpdateAttendance(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:event_jobs,id',
            'attendance_data' => 'required|array',
            'attendance_data.*.promoter_id' => 'required|exists:promoters,id',
            'attendance_data.*.date' => 'required|date',
            'attendance_data.*.status' => 'required|in:attend,absent',
        ]);

        try {
            $updatedCount = 0;
            $attendanceData = $request->attendance_data;

            foreach ($attendanceData as $attendance) {
                Attendance::markAttendance(
                    $attendance['promoter_id'],
                    $request->event_id,
                    $attendance['date'],
                    $attendance['status']
                );
                $updatedCount++;
            }

            return response()->json([
                'success' => true,
                'message' => "Successfully updated {$updatedCount} attendance records",
                'updated_count' => $updatedCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating attendance: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update salary settings for an event job
     */
    public function updateSalarySettings(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:event_jobs,id',
            'default_commission_coordinator' => 'nullable|numeric|min:0|max:100',
            'default_salary_promoter' => 'nullable|numeric|min:0',
            'salary_rules' => 'nullable|string|max:5000',
            'special_note' => 'nullable|string|max:2000',
        ]);

        try {
            $eventJob = EventJob::findOrFail($request->event_id);
            
            $eventJob->update([
                'default_commission_coordinator' => $request->default_commission_coordinator,
                'default_salary_promoter' => $request->default_salary_promoter,
                'salary_rules' => $request->salary_rules,
                'special_note' => $request->special_note,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Salary settings updated successfully',
                'event_job' => $eventJob->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating salary settings: ' . $e->getMessage()
            ], 500);
        }
    }
}

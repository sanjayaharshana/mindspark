<div class="container-fluid">
<div class="row mb-4">
    <div class="col-12">
            <div class="card">
                <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                            <h3 class="mb-0">{{ $eventJob->job_name }}</h3>
                                <small class="text-muted">Job #{{ $eventJob->job_number }} | {{ $eventJob->client_name }}</small>
                    </div>
                    <div class="col-md-4 text-end">
                            <a href="{{ admin_url('event-jobs') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabs -->
                <ul class="nav nav-tabs" id="salaryTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                            Overview
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="promoters-tab" data-bs-toggle="tab" data-bs-target="#promoters" type="button" role="tab">
                            Promoters ({{ $assignedPromoters->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="calculation-tab" data-bs-toggle="tab" data-bs-target="#calculation" type="button" role="tab">
                            Salary Calculation
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab">
                            Attendance
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="salaryTabsContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <!-- Key Metrics Cards -->
                            <div class="row mt-3 mb-4">
                            <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-left-primary">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Job Number</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventJob->job_number }}</div>
                                    </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                    </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-left-success">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Promoters</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assignedPromoters->count() }}</div>
                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-left-info">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Duration</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @if($eventJob->activation_start_date && $eventJob->activation_end_date)
                                                            {{ $eventJob->activation_start_date->diffInDays($eventJob->activation_end_date) + 1 }} days
                                            @else
                                                N/A
                                            @endif
                                    </div>
                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                                    </div>
                                        </div>
                                        </div>
                                <div class="col-lg-3 col-md-6 mb-3">
                                    <div class="card border-left-warning">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Client</div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">{{ Str::limit($eventJob->client_name, 15) }}</div>
                                        </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-building fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>

                            <!-- Detailed Information -->
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary">
                                                <i class="fas fa-info-circle"></i> Job Details
                                            </h6>
                                    </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Job Name:</strong></td>
                                                    <td>{{ $eventJob->job_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Start Date:</strong></td>
                                                    <td>{{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('M d, Y') : 'Not Set' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>End Date:</strong></td>
                                                    <td>{{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('M d, Y') : 'Ongoing' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Created:</strong></td>
                                                    <td>{{ $eventJob->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        </div>
                                        </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-success">
                                                <i class="fas fa-user-tie"></i> Personnel
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Officer:</strong></td>
                                                    <td>{{ $eventJob->officer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Reporter:</strong></td>
                                                    <td>{{ $eventJob->reporter_officer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status:</strong></td>
                                                    <td><span class="badge badge-success">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Last Updated:</strong></td>
                                                    <td>{{ $eventJob->updated_at->diffForHumans() }}</td>
                                                </tr>
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Promoters Tab -->
                    <div class="tab-pane fade" id="promoters" role="tabpanel">
                            <div class="mt-3">
                            <!-- Header with Assign Button -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0 text-muted">Assigned Promoters ({{ $assignedPromoters->count() }})</h5>
                                <a href="{{ admin_url('event-jobs/' . $eventJob->id . '/assign-promoters') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Assign More Promoters
                                </a>
                            </div>
                            
                                @if($assignedPromoters->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-white">#</th>
                                            <th class="text-white">Promoter ID</th>
                                            <th class="text-white">Name</th>
                                            <th class="text-white">ID Number</th>
                                            <th class="text-white">Phone</th>
                                            <th class="text-white">Coordinator</th>
                                            <th class="text-white">Daily Salary</th>
                                                    <th class="text-white">Commission</th>
                                            <th class="text-white">Bank Details</th>
                                            <th class="text-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignedPromoters as $index => $assignment)
                                            <tr>
                                                        <td class="font-weight-bold">{{ $index + 1 }}</td>
                                                        <td><span class="badge badge-primary">{{ $assignment->promoter->promoter_id }}</span></td>
                                                        <td class="font-weight-medium">{{ $assignment->promoter->promoter_name }}</td>
                                                <td>{{ $assignment->promoter->id_no }}</td>
                                                <td>{{ $assignment->promoter->phone_no }}</td>
                                                <td>
                                                            <span class="badge badge-info">{{ $assignment->coordinator->coordinator_name }}</span>
                                                </td>
                                                <td>
                                                            <span class="text-success font-weight-bold">Rs. {{ number_format($assignment->promoter_salary_per_day, 2) }}</span>
                                                </td>
                                                <td>
                                                            <span class="text-warning font-weight-bold">Rs. {{ number_format($assignment->supervisor_commission, 2) }}</span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $assignment->promoter->bank_name }}</small><br>
                                                    <small>{{ $assignment->promoter->account_number }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button class="btn btn-outline-primary" onclick="editPromoter({{ $assignment->promoter->id }})">
                                                                    <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-outline-success" onclick="calculateSalary({{ $assignment->promoter->id }})">
                                                                    <i class="fas fa-calculator"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                                    <div class="alert alert-info text-center">
                                        <div class="py-4">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h4 class="alert-heading">No Promoters Assigned</h4>
                                            <p>This event job doesn't have any promoters assigned yet.</p>
                                <a href="{{ admin_url('event-jobs/' . $eventJob->id . '/assign-promoters') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Assign Promoters
                                </a>
                                        </div>
                            </div>
                        @endif
                            </div>
                    </div>

                    <!-- Salary Calculation Tab -->
                    <div class="tab-pane fade" id="calculation" role="tabpanel">
                            <div class="mt-3">
                        <div class="row">
                            <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    <i class="fas fa-calculator"></i> Salary Calculation
                                                </h6>
                                    </div>
                                            <div class="card-body">
                                        <form id="salary-form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Daily Rate (Rs.)</label>
                                                        <input type="number" class="form-control" id="daily_rate" placeholder="Enter daily rate">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Overtime Rate (Rs.)</label>
                                                        <input type="number" class="form-control" id="overtime_rate" placeholder="Enter overtime rate">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Bonus (Rs.)</label>
                                                        <input type="number" class="form-control" id="bonus" placeholder="Enter bonus amount">
                                                    </div>
                                                </div>
                                            </div>
                                                    <div class="mt-3">
                                                <button type="button" class="btn btn-primary" onclick="calculateAllSalaries()">
                                                            <i class="fas fa-calculator"></i> Calculate All Salaries
                                                </button>
                                                <button type="button" class="btn btn-success" onclick="generateSalarySheet()">
                                                            <i class="fas fa-file"></i> Generate Report
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-success">
                                                    <i class="fas fa-chart-pie"></i> Summary
                                                </h6>
                                    </div>
                                            <div class="card-body" id="salary-summary">
                                                <div class="text-center text-muted">
                                                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                                                    <p>Set parameters and calculate to see summary</p>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Tab -->
                    <div class="tab-pane fade" id="attendance" role="tabpanel">
                            <div class="mt-3">
                                        @if($eventJob->activation_start_date && $eventJob->activation_end_date)
                                            @php
                                                $startDate = $eventJob->activation_start_date;
                                                $endDate = $eventJob->activation_end_date;
                                                $days = [];
                                                $currentDate = $startDate->copy();
                                                
                                                while ($currentDate->lte($endDate)) {
                                                    $days[] = $currentDate->copy();
                                                    $currentDate->addDay();
                                                }
                                            @endphp
                                            
                                    <!-- Event Summary -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="card border-left-info">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Event Summary</div>
                                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                {{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}
                                                            </div>
                                                            <div class="text-xs text-muted">Total Days: {{ count($days) }}</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-left-success">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Quick Actions</div>
                                                            <div class="btn-group btn-group-sm">
                                                                <button class="btn btn-outline-primary" onclick="markAllPresent()">
                                                                    <i class="fas fa-check"></i> Mark All Present
                                                                </button>
                                                                <button class="btn btn-outline-success" onclick="exportAttendance()">
                                                                    <i class="fas fa-download"></i> Export
                                                            </button>
                                                        </div>
                                                    </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Debug Information -->
                                    <div class="card mb-3">
                                        <div class="card-header bg-warning">
                                            <h6 class="m-0 font-weight-bold text-dark">
                                                <i class="fas fa-bug"></i> Debug Information
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Assigned Promoters:</strong> {{ $assignedPromoters->count() }}
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Attendance Records:</strong> {{ count($attendanceData) }}
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Event Dates:</strong> {{ count($eventDates ?? []) }}
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Days Array:</strong> {{ count($days ?? []) }}
                                                </div>
                                            </div>
                                            @if($assignedPromoters->count() > 0)
                                                <div class="mt-2">
                                                    <strong>Promoter IDs:</strong> 
                                                    @foreach($assignedPromoters as $assignment)
                                                        {{ $assignment->promoter->id }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if($assignedPromoters->count() > 0)
                                        <!-- Search and Filter Section -->
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    <i class="fas fa-search"></i> Search & Filter Promoters
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Search by Name or ID</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="promoterSearch"
                                                                       placeholder="Enter promoter name or ID..."
                                                                       onkeyup="filterPromoters()"
                                                                       onfocus="showSearchSuggestions()"
                                                                       onblur="hideSearchSuggestions()">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                                                        <i class="fas fa-times"></i>
                                                        </button>
                                                        </div>
                                                    </div>
                                                            <div id="searchSuggestions" class="search-suggestions" style="display: none;"></div>
                                                </div>
                                            </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Sort By</label>
                                                            <select class="form-control" id="sortBy" onchange="sortPromoters()">
                                                                <option value="name">Name</option>
                                                                <option value="id">ID</option>
                                                                <option value="present">Present Days</option>
                                                                <option value="absent">Absent Days</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Filter by Status</label>
                                                            <select class="form-control" id="statusFilter" onchange="filterPromoters()">
                                                                <option value="">All Promoters</option>
                                                                <option value="present">Present Only</option>
                                                                <option value="absent">Absent Only</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Quick Actions</label>
                                                            <div class="btn-group w-100" role="group">
                                                                <button class="btn btn-outline-primary btn-sm" onclick="clearFilters()">
                                                                    <i class="fas fa-times"></i> Clear
                                                        </button>
                                                                <button class="btn btn-outline-success btn-sm" onclick="exportFiltered()">
                                                                    <i class="fas fa-download"></i> Export
                                                        </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                <div class="col-md-6">
                                                        <div class="d-flex align-items-center">
                                                            <small class="text-muted" id="filterResults">
                                                                Showing {{ $assignedPromoters->count() }} promoters
                                                            </small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="d-flex justify-content-end">
                                                            <div class="btn-group btn-group-sm mr-3">
                                                                <button class="btn btn-outline-primary" onclick="selectAllVisible()">
                                                                    <i class="fas fa-check-square"></i> Select All Visible
                                                        </button>
                                                                <button class="btn btn-outline-success" onclick="markSelectedPresent()">
                                                                    <i class="fas fa-check"></i> Mark Selected Present
                                                        </button>
                                                                <button class="btn btn-outline-info" onclick="testSearch()">
                                                                    <i class="fas fa-bug"></i> Test Search
                                                                </button>
                                                                <button class="btn btn-outline-secondary" onclick="clearSavedTab()">
                                                                    <i class="fas fa-trash"></i> Clear Saved Tab
                                                        </button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                                </div>
                                            </div>

                                        <!-- Detailed Attendance Table -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    <i class="fas fa-table"></i> Detailed Attendance
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm">
                                                        <thead class="table-primary" style="background: blue">
                                                            <tr>
                                                                <th class="text-white sticky-column" style="background: #0d6efd !important;">Promoter</th>
                                                                @foreach($days as $day)
                                                                    <th class="text-white text-center" style="min-width: 60px;background: #01429f !important;">
                                                                        {{ $day->format('M d') }}<br>
                                                                        <small>{{ $day->format('D') }}</small>
                                                                    </th>
                                                                @endforeach
                                                                <th class="text-white text-center sticky-column-right" style="background: #0d6efd !important;">Total</th>
                                                                <th class="text-white text-center sticky-column-right" style="background: #0d6efd !important;">Present</th>
                                                                <th class="text-white text-center sticky-column-right" style="background: #0d6efd !important;">Absent</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if($assignedPromoters->count() > 0)
                                                            @foreach($assignedPromoters as $assignment)
                                                                <tr>
                                                                        <td class="font-weight-medium sticky-column" style="background: #dcdcdc">
                                                                            <strong>{{ $assignment->promoter->promoter_name }}</strong><br>
                                                                            <small class="text-muted">{{ $assignment->promoter->promoter_id }}</small>
                                                                    </td>
                                                                    @foreach($days as $day)
                                                                        @php
                                                                            $dayKey = $day->format('Y-m-d');
                                                                            $isPresent = false;
                                                                            if (isset($attendanceData[$assignment->promoter->id])) {
                                                                                $promoterAttendance = $attendanceData[$assignment->promoter->id];
                                                                                foreach ($promoterAttendance as $attendance) {
                                                                                    if ($attendance->promoter_attend_date->format('Y-m-d') === $dayKey) {
                                                                                        $isPresent = ($attendance->status === 'attend');
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <td class="text-center">
                                                                            <div class="form-check d-inline-block">
                                                                                <input type="checkbox" 
                                                                                       class="form-check-input attendance-check" 
                                                                                       data-promoter="{{ $assignment->promoter->id }}" 
                                                                                       data-date="{{ $dayKey }}"
                                                                                       {{ $isPresent ? 'checked' : '' }}
                                                                                       onchange="updateAttendance(this)">
                                                                                <label class="form-check-label">
                                                                                    @if($isPresent)
                                                                                        <i class="fas fa-check text-success"></i>
                                                                                    @else
                                                                                        <i class="fas fa-times text-danger"></i>
                                                                                    @endif
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    @endforeach
                                                                    <td class="text-center font-weight-bold sticky-column-right">{{ count($days) }}</td>
                                                                    @php
                                                                        $presentCount = 0;
                                                                        $absentCount = 0;
                                                                        if (isset($attendanceData[$assignment->promoter->id])) {
                                                                            $promoterAttendance = $attendanceData[$assignment->promoter->id];
                                                                            foreach ($promoterAttendance as $attendance) {
                                                                                if ($attendance->status === 'attend') {
                                                                                    $presentCount++;
                                                                                } else {
                                                                                    $absentCount++;
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $absentCount = count($days);
                                                                        }
                                                                    @endphp
                                                                    <td class="text-center sticky-column-right">
                                                                        <span class="badge badge-success" id="present-{{ $assignment->promoter->id }}">{{ $presentCount }}</span>
                                                                    </td>
                                                                    <td class="text-center sticky-column-right">
                                                                        <span class="badge badge-danger" id="absent-{{ $assignment->promoter->id }}">{{ $absentCount }}</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="{{ count($days) + 4 }}" class="text-center py-4">
                                                                        <div class="alert alert-info">
                                                                            <i class="fas fa-info-circle"></i>
                                                                            <strong>No promoters assigned to this event.</strong>
                                                                            <br>
                                                                            <small>Please assign promoters first to view attendance data.</small>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- Save Button -->
                                                <div class="mt-3 text-center">
                                                    <button class="btn btn-success" onclick="saveAllAttendance()">
                                                        <i class="fas fa-save"></i> Save All Changes
                                                    </button>
                                                    <div class="mt-2">
                                                        <small class="text-muted" id="saveStatus">Click Save All Changes to save</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning text-center">
                                            <div class="py-4">
                                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                                <h4 class="alert-heading">No Promoters Assigned</h4>
                                                <p>Please assign promoters first to manage attendance.</p>
                                                    <a href="{{ admin_url('event-jobs/' . $eventJob->id . '/assign-promoters') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Assign Promoters
                                                    </a>
                                            </div>
                                                </div>
                                            @endif
                                        @else
                                    <div class="alert alert-warning text-center">
                                        <div class="py-4">
                                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                            <h4 class="alert-heading">Event Dates Not Set</h4>
                                            <p>Please set the event start and end dates to manage attendance.</p>
                                                </div>
                                            </div>
                                        @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize variables first
let filterTimeout;
let currentFilters = {
    search: '',
    status: '',
    sortBy: 'name',
    sortOrder: 'asc'
};

// Essential JavaScript functions for salary sheet functionality
document.addEventListener('DOMContentLoaded', function() {
    // Tab persistence functionality
    const TAB_STORAGE_KEY = 'salarySheetActiveTab';
    
    // Function to save active tab
    function saveActiveTab(tabId) {
        localStorage.setItem(TAB_STORAGE_KEY, tabId);
    }
    
    // Function to restore active tab
    function restoreActiveTab() {
        const savedTab = localStorage.getItem(TAB_STORAGE_KEY);
        if (savedTab) {
            const tabButton = document.querySelector(`[data-bs-target="#${savedTab}"]`);
            if (tabButton) {
                // Remove active class from all tabs
                document.querySelectorAll('#salaryTabs button').forEach(btn => {
                    btn.classList.remove('active');
                });
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('active', 'show');
                });
                
                // Activate saved tab
                tabButton.classList.add('active');
                const targetPane = document.getElementById(savedTab);
                if (targetPane) {
                    targetPane.classList.add('active', 'show');
                }
                
                
                return true;
            }
        }
        return false;
    }
    
    // Initialize Bootstrap tabs with persistence
    const tabButtons = document.querySelectorAll('#salaryTabs button');
    tabButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-bs-target');
            const targetTab = document.querySelector(targetId);

            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });

            // Remove active class from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Show target tab and activate button
            if (targetTab) {
                targetTab.classList.add('show', 'active');
                this.classList.add('active');
                
                // Save active tab (remove # from targetId)
                const tabId = targetId.replace('#', '');
                saveActiveTab(tabId);
                
            }
        });
    });
    
    // Add event listeners to attendance checkboxes
    const attendanceCheckboxes = document.querySelectorAll('input[type="checkbox"][data-promoter][data-date]');
    attendanceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateAttendanceCounters();
            updateSaveStatus('Changes detected. Click Save All Changes to save.', 'warning');
        });
    });
    
    // Initialize attendance counters
    updateAttendanceCounters();
    
});

// Promoter management functions
function editPromoter(promoterId) {
    alert('Edit promoter functionality will be implemented here. Promoter ID: ' + promoterId);
}

function calculateSalary(promoterId) {
    alert('Calculate salary for promoter ID: ' + promoterId);
}

// Salary calculation functions
function calculateAllSalaries() {
    var dailyRate = document.getElementById('daily_rate').value;
    var overtimeRate = document.getElementById('overtime_rate').value;
    var bonus = document.getElementById('bonus').value;

    if (!dailyRate) {
        alert('Please enter a daily rate');
        return;
    }

    var totalPromoters = {{ $assignedPromoters->count() }};
    var totalDays = {{ $eventJob->activation_start_date && $eventJob->activation_end_date ? $eventJob->activation_start_date->diffInDays($eventJob->activation_end_date) + 1 : 0 }};

    if (totalDays === 0) {
        alert('Cannot calculate salary: Event duration is not set');
        return;
    }

    var totalSalary = totalPromoters * totalDays * dailyRate;
    var totalOvertime = totalPromoters * (overtimeRate || 0);
    var totalBonus = totalPromoters * (bonus || 0);
    var grandTotal = totalSalary + totalOvertime + totalBonus;

    var summaryHtml = `
        <div class="row">
            <div class="col-6"><strong>Total Promoters:</strong></div>
            <div class="col-6">${totalPromoters}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Total Days:</strong></div>
            <div class="col-6">${totalDays}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Base Salary:</strong></div>
            <div class="col-6">Rs. ${totalSalary.toLocaleString()}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Overtime:</strong></div>
            <div class="col-6">Rs. ${totalOvertime.toLocaleString()}</div>
        </div>
        <div class="row">
            <div class="col-6"><strong>Bonus:</strong></div>
            <div class="col-6">Rs. ${totalBonus.toLocaleString()}</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6"><strong>Grand Total:</strong></div>
            <div class="col-6"><strong>Rs. ${grandTotal.toLocaleString()}</strong></div>
        </div>
    `;

    document.getElementById('salary-summary').innerHTML = summaryHtml;
}

function generateSalarySheet() {
    alert('Salary sheet generation functionality will be implemented here');
}

// Attendance management functions
function updateAttendance(checkbox) {
    const promoterId = checkbox.dataset.promoter;
    const date = checkbox.dataset.date;
    const status = checkbox.checked ? 'attend' : 'absent';

    // Update visual feedback immediately
    const label = checkbox.nextElementSibling;
    if (checkbox.checked) {
        label.innerHTML = '<i class="fas fa-check text-success"></i>';
    } else {
        label.innerHTML = '<i class="fas fa-times text-danger"></i>';
    }

    // Update attendance counts
    updateAttendanceCounts(promoterId);

    // Update save status
    updateSaveStatus('Changes pending - Click Save All Changes', 'warning');
}

function updateAttendanceCounts(promoterId) {
    // Count present/absent days for this promoter
    const promoterCheckboxes = document.querySelectorAll(`[data-promoter="${promoterId}"]`);
    let presentCount = 0;
    let absentCount = 0;

    promoterCheckboxes.forEach(cb => {
        if (cb.checked) {
            presentCount++;
        } else {
            absentCount++;
        }
    });

    // Update badges
    const presentBadge = document.getElementById(`present-${promoterId}`);
    const absentBadge = document.getElementById(`absent-${promoterId}`);

    if (presentBadge) presentBadge.textContent = presentCount;
    if (absentBadge) absentBadge.textContent = absentCount;
}

function markAllPresent() {
    if (confirm('Are you sure you want to mark all promoters as present for all days?')) {
                // Update all checkboxes visually
                const checkboxes = document.querySelectorAll('.attendance-check');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    const label = checkbox.nextElementSibling;
            label.innerHTML = '<i class="fas fa-check text-success"></i>';
                });
                
                // Update all attendance counts
                const promoterIds = [...new Set(Array.from(checkboxes).map(cb => cb.dataset.promoter))];
                promoterIds.forEach(promoterId => {
                    updateAttendanceCounts(promoterId);
                });
                
        updateSaveStatus('All promoters marked as present', 'success');
    }
}

function exportAttendance() {
    alert('Export attendance functionality will be implemented here');
}

function saveAllAttendance() {
    console.log('=== SAVING ALL ATTENDANCE CHANGES ===');
    
    // Check if we're on the attendance tab
    const attendanceTab = document.getElementById('attendance');
    if (!attendanceTab || !attendanceTab.classList.contains('active')) {
        alert('Please switch to the Attendance tab first to save attendance data.');
        return;
    }
    
    // Get all attendance checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"][data-promoter][data-date]');
    console.log('Found', checkboxes.length, 'attendance checkboxes');
    
    if (checkboxes.length === 0) {
        alert('No attendance data found to save.');
        return;
    }
    
    // Collect attendance data
    const attendanceData = [];
    const eventId = {{ $eventJob->id }};
    
    checkboxes.forEach(checkbox => {
        const promoterId = checkbox.getAttribute('data-promoter');
        const date = checkbox.getAttribute('data-date');
        const status = checkbox.checked ? 'attend' : 'absent';
        
        attendanceData.push({
            promoter_id: parseInt(promoterId),
            date: date,
            status: status
        });
    });
    
    console.log('Collected attendance data:', attendanceData);
    
    // Show loading state
    updateSaveStatus('Saving attendance data...', 'info');
    const saveButton = document.querySelector('button[onclick="saveAllAttendance()"]');
    if (saveButton) {
        saveButton.disabled = true;
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    }
    
    // Send data to server
    fetch('{{ admin_url("event-jobs/bulk-update-attendance") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            event_id: eventId,
            attendance_data: attendanceData
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Save response:', data);
        
        if (data.success) {
            updateSaveStatus(`Successfully saved ${data.updated_count || attendanceData.length} attendance records!`, 'success');
            
            // Update attendance counters
            updateAttendanceCounters();
            
            // Show success message
            showNotification('Attendance saved successfully!', 'success');
        } else {
            updateSaveStatus('Error saving attendance: ' + (data.message || 'Unknown error'), 'danger');
            showNotification('Error saving attendance: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error saving attendance:', error);
        updateSaveStatus('Error saving attendance: ' + error.message, 'danger');
        showNotification('Error saving attendance: ' + error.message, 'error');
    })
    .finally(() => {
        // Reset button state
        if (saveButton) {
            saveButton.disabled = false;
            saveButton.innerHTML = '<i class="fas fa-save"></i> Save All Changes';
        }
    });
}

function updateAttendanceCounters() {
    // Update present/absent counters for each promoter
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const promoterId = row.querySelector('input[data-promoter]')?.getAttribute('data-promoter');
        if (!promoterId) return;
        
        const checkboxes = row.querySelectorAll(`input[data-promoter="${promoterId}"]`);
        let presentCount = 0;
        let absentCount = 0;
        
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                presentCount++;
            } else {
                absentCount++;
            }
        });
        
        // Update the counters in the row
        const presentBadge = row.querySelector(`#present-${promoterId}`);
        const absentBadge = row.querySelector(`#absent-${promoterId}`);
        
        if (presentBadge) {
            presentBadge.textContent = presentCount;
        }
        if (absentBadge) {
            absentBadge.textContent = absentCount;
        }
    });
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show`;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 5000);
}

function updateSaveStatus(message, type = 'info') {
    const statusElement = document.getElementById('saveStatus');
    if (statusElement) {
        statusElement.textContent = message;
        statusElement.className = 'text-muted';

        if (type === 'success') {
            statusElement.className = 'text-success';
        } else if (type === 'warning') {
            statusElement.className = 'text-warning';
        } else if (type === 'error') {
            statusElement.className = 'text-danger';
        }
    }
}

// Dynamic search and filter functions

function filterPromoters() {
    console.log('=== FILTER PROMOTERS CALLED ===');
    
    // Clear previous timeout to prevent multiple rapid calls
    clearTimeout(filterTimeout);

    // Debounce the filtering for better performance
    filterTimeout = setTimeout(() => {
        console.log('Executing performFiltering...');
        performFiltering();
    }, 150);
}

function performFiltering() {
    console.log('=== PERFORM FILTERING STARTED ===');
    
    const searchInput = document.getElementById('promoterSearch');
    const statusFilter = document.getElementById('statusFilter');

    // Check if elements exist
    if (!searchInput || !statusFilter) {
        console.warn('Search or filter elements not found');
        console.log('searchInput:', searchInput);
        console.log('statusFilter:', statusFilter);
        return;
    }

    const searchTerm = searchInput.value.toLowerCase();
    const statusValue = statusFilter.value;
    const allRows = Array.from(document.querySelectorAll('tbody tr'));
    
    console.log('Filtering with search term:', searchTerm, 'status:', statusValue);
    console.log('Found rows:', allRows.length);
    
    if (allRows.length === 0) {
        console.warn('No table rows found!');
        return;
    }

    // Update current filters
    currentFilters.search = searchTerm;
    currentFilters.status = statusValue;

    // Filter rows based on search and status
    filteredRows = allRows.filter((row, index) => {
        const promoterCell = row.querySelector('td:first-child');
        const presentBadge = row.querySelector('.badge-success');
        const absentBadge = row.querySelector('.badge-danger');

        if (!promoterCell) {
            console.warn('Required promoter cell not found in row', index);
            return false;
        }

        const cellText = promoterCell.textContent ? promoterCell.textContent.toLowerCase() : '';

        // Check search term with fuzzy matching
        const matchesSearch = searchTerm === '' ||
                             cellText.includes(searchTerm) ||
                             fuzzyMatch(cellText, searchTerm);

        // Check status filter
        let matchesStatus = true;
        if (statusValue === 'present') {
            matchesStatus = presentBadge && presentBadge.textContent && parseInt(presentBadge.textContent) > 0;
        } else if (statusValue === 'absent') {
            matchesStatus = absentBadge && absentBadge.textContent && parseInt(absentBadge.textContent) > 0;
        }

        return matchesSearch && matchesStatus;
    });

    // Show/hide rows based on filter results
    allRows.forEach((row, index) => {
        const isVisible = filteredRows.includes(row);
        row.style.display = isVisible ? '' : 'none';
        
        // Add animation effect
        if (isVisible) {
            row.style.opacity = '0';
            setTimeout(() => {
                row.style.opacity = '1';
            }, index * 10);
        }
    });
    
    // Update filter results
    updateFilterResults(filteredRows.length);
    
    // Update quick action buttons state
    updateQuickActionButtons(filteredRows.length > 0);
    
    // Highlight search terms
    highlightSearchTerms(searchTerm);
    
    console.log('=== PERFORM FILTERING COMPLETED ===');
    console.log('Filtered rows:', filteredRows.length);
}

function fuzzyMatch(text, pattern) {
    if (!pattern) return true;

    const textLower = text.toLowerCase();
    const patternLower = pattern.toLowerCase();

    let patternIndex = 0;
    for (let i = 0; i < textLower.length && patternIndex < patternLower.length; i++) {
        if (textLower[i] === patternLower[patternIndex]) {
            patternIndex++;
        }
    }

    return patternIndex === patternLower.length;
}

function highlightSearchTerms(searchTerm) {
    if (!searchTerm) {
        // Remove all highlights
        document.querySelectorAll('.search-highlight').forEach(el => {
            el.classList.remove('search-highlight');
        });
        return;
    }

    const rows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
    rows.forEach(row => {
        const promoterCell = row.querySelector('td:first-child'); // First column contains both name and ID

        // Highlight in promoter cell (contains both name and ID)
        if (promoterCell && promoterCell.textContent && promoterCell.textContent.toLowerCase().includes(searchTerm)) {
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            promoterCell.innerHTML = promoterCell.textContent.replace(regex, '<span class="search-highlight">$1</span>');
        }
    });
}

function updateFilterResults(count) {
    const resultsElement = document.getElementById('filterResults');

    if (!resultsElement) {
        console.warn('Filter results element not found');
        return;
    }

    const totalPromoters = {{ $assignedPromoters->count() }};

    // Animate the counter
    resultsElement.style.transition = 'all 0.3s ease';
    resultsElement.style.transform = 'scale(1.1)';

    setTimeout(() => {
        resultsElement.textContent = `Showing ${count} of ${totalPromoters} promoters`;
        resultsElement.style.transform = 'scale(1)';

        // Add color coding based on results
        if (count === 0) {
            resultsElement.className = 'text-danger';
        } else if (count < totalPromoters) {
            resultsElement.className = 'text-warning';
        } else {
            resultsElement.className = 'text-success';
        }
    }, 150);
}

function updateQuickActionButtons(hasResults) {
    const buttons = document.querySelectorAll('.btn-group-sm button');
    buttons.forEach(button => {
        if (hasResults) {
            button.disabled = false;
            button.style.opacity = '1';
        } else {
            button.disabled = true;
            button.style.opacity = '0.5';
        }
    });
}

function clearFilters() {
    document.getElementById('promoterSearch').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('sortBy').value = 'name';
    currentFilters = { search: '', status: '', sortBy: 'name', sortOrder: 'asc' };
    filterPromoters();
}

function clearSearch() {
    document.getElementById('promoterSearch').value = '';
    filterPromoters();
    hideSearchSuggestions();
}

function sortPromoters() {
    const sortBy = document.getElementById('sortBy').value;
    const tbody = document.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    // Toggle sort order if clicking same column
    if (currentFilters.sortBy === sortBy) {
        currentFilters.sortOrder = currentFilters.sortOrder === 'asc' ? 'desc' : 'asc';
    } else {
        currentFilters.sortBy = sortBy;
        currentFilters.sortOrder = 'asc';
    }

    rows.sort((a, b) => {
        let aValue, bValue;

        switch (sortBy) {
            case 'name':
                aValue = a.querySelector('td:nth-child(3)').textContent.toLowerCase();
                bValue = b.querySelector('td:nth-child(3)').textContent.toLowerCase();
                break;
            case 'id':
                aValue = a.querySelector('td:nth-child(2)').textContent.toLowerCase();
                bValue = b.querySelector('td:nth-child(2)').textContent.toLowerCase();
                break;
            case 'present':
                aValue = parseInt(a.querySelector('.badge-success').textContent) || 0;
                bValue = parseInt(b.querySelector('.badge-success').textContent) || 0;
                break;
            case 'absent':
                aValue = parseInt(a.querySelector('.badge-danger').textContent) || 0;
                bValue = parseInt(b.querySelector('.badge-danger').textContent) || 0;
                break;
            default:
                return 0;
        }

        if (currentFilters.sortOrder === 'asc') {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });

    // Re-append sorted rows with animation
    rows.forEach((row, index) => {
        row.style.transition = 'all 0.3s ease';
        row.style.transform = `translateY(${index * 2}px)`;
        tbody.appendChild(row);
    });

    // Update sort indicator
    updateSortIndicator();
}

function updateSortIndicator() {
    const sortBy = document.getElementById('sortBy');
    const sortIcon = sortBy.parentElement.querySelector('.sort-icon');

    if (sortIcon) {
        sortIcon.remove();
    }

    const icon = document.createElement('i');
    icon.className = `fas fa-sort-${currentFilters.sortOrder === 'asc' ? 'up' : 'down'} sort-icon`;
    icon.style.marginLeft = '5px';
    icon.style.color = 'var(--primary-color)';

    sortBy.parentElement.appendChild(icon);
}

function showSearchSuggestions() {
    const searchInput = document.getElementById('promoterSearch');
    const suggestionsDiv = document.getElementById('searchSuggestions');
    const searchTerm = searchInput.value.toLowerCase();

    if (searchTerm.length < 2) {
        hideSearchSuggestions();
        return;
    }
    
    const rows = document.querySelectorAll('tbody tr');
    const suggestions = new Set();

    rows.forEach(row => {
        const promoterCell = row.querySelector('td:first-child');
        if (promoterCell && promoterCell.textContent) {
            const cellText = promoterCell.textContent.toLowerCase();

            // Extract name and ID from the cell text
            const lines = cellText.split('\n');
            const name = lines[0] ? lines[0].trim() : '';
            const id = lines[1] ? lines[1].trim() : '';

            if (name.includes(searchTerm)) {
                suggestions.add(name);
            }
            if (id.includes(searchTerm)) {
                suggestions.add(id);
            }
        }
    });

    if (suggestions.size > 0) {
        suggestionsDiv.innerHTML = Array.from(suggestions)
            .slice(0, 5)
            .map(suggestion => `<div class="suggestion-item" onclick="selectSuggestion('${suggestion}')">${suggestion}</div>`)
            .join('');

        suggestionsDiv.style.display = 'block';
    } else {
        hideSearchSuggestions();
    }
}

function hideSearchSuggestions() {
    setTimeout(() => {
        document.getElementById('searchSuggestions').style.display = 'none';
    }, 200);
}

function selectSuggestion(suggestion) {
    document.getElementById('promoterSearch').value = suggestion;
    hideSearchSuggestions();
    filterPromoters();
}

function selectAllVisible() {
    const visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
    const checkboxes = [];

    visibleRows.forEach(row => {
        const rowCheckboxes = row.querySelectorAll('.attendance-check');
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
            const label = checkbox.nextElementSibling;
            label.innerHTML = '<i class="fas fa-check text-success"></i>';
            checkboxes.push(checkbox);
        });
    });

    // Update counts for all promoters
    const promoterIds = [...new Set(checkboxes.map(cb => cb.dataset.promoter))];
    promoterIds.forEach(promoterId => {
        updateAttendanceCounts(promoterId);
    });

    updateSaveStatus(`${checkboxes.length} attendance records selected`, 'success');
}

function markSelectedPresent() {
    const visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
    let markedCount = 0;

    visibleRows.forEach(row => {
        const checkboxes = row.querySelectorAll('.attendance-check');
        checkboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                checkbox.checked = true;
                const label = checkbox.nextElementSibling;
                label.innerHTML = '<i class="fas fa-check text-success"></i>';
                markedCount++;
            }
        });
    });

    // Update counts for all promoters
    const promoterIds = [...new Set(Array.from(document.querySelectorAll('.attendance-check')).map(cb => cb.dataset.promoter))];
    promoterIds.forEach(promoterId => {
        updateAttendanceCounts(promoterId);
    });

    updateSaveStatus(`${markedCount} attendance records marked as present`, 'success');
}

function exportFiltered() {
    const visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
    let csvContent = "Promoter Name,Promoter ID,Total Days,Present Days,Absent Days\n";

    visibleRows.forEach(row => {
        const promoterCell = row.querySelector('td:first-child');
        if (promoterCell && promoterCell.textContent) {
            const cellText = promoterCell.textContent.trim();
            const lines = cellText.split('\n');
            const promoterName = lines[0] ? lines[0].trim() : '';
            const promoterId = lines[1] ? lines[1].trim() : '';

            const totalDays = row.querySelector('td:nth-last-child(3)') ? row.querySelector('td:nth-last-child(3)').textContent.trim() : '0';
            const presentDays = row.querySelector('.badge-success') ? row.querySelector('.badge-success').textContent.trim() : '0';
            const absentDays = row.querySelector('.badge-danger') ? row.querySelector('.badge-danger').textContent.trim() : '0';

            csvContent += `"${promoterName}","${promoterId}","${totalDays}","${presentDays}","${absentDays}"\n`;
        }
    });

    // Create and download CSV file
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'attendance_report.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);

    updateSaveStatus('Attendance report exported successfully', 'success');
}




// Function to clear saved tab
function clearSavedTab() {
    localStorage.removeItem('salarySheetActiveTab');
    console.log('Saved tab cleared. Page will default to first tab on next refresh.');
    alert('Saved tab cleared! Page will default to first tab on next refresh.');
}

// Test function to debug search
function testSearch() {
    console.log('=== TESTING SEARCH FUNCTIONALITY ===');

    // Check if we're on the attendance tab
    const attendanceTab = document.getElementById('attendance');
    if (!attendanceTab || !attendanceTab.classList.contains('active')) {
        alert('Please switch to the Attendance tab first to test search functionality.');
        return;
    }

    // Check table structure
    const rows = document.querySelectorAll('tbody tr');
    console.log('Total rows found:', rows.length);

    if (rows.length === 0) {
        alert('No attendance table rows found. Make sure you are on the Attendance tab.');
        return;
    }

    // Test first row
    const firstRow = rows[0];
    const promoterCell = firstRow.querySelector('td:first-child');

    if (promoterCell) {
        console.log('First row promoter cell text:', promoterCell.textContent);
        console.log('First row promoter cell HTML:', promoterCell.innerHTML);

        // Test search with first promoter name
        const cellText = promoterCell.textContent.toLowerCase();
        const lines = cellText.split('\n');
        const promoterName = lines[0] ? lines[0].trim() : '';

        if (promoterName) {
            console.log('Testing search with:', promoterName);
            document.getElementById('promoterSearch').value = promoterName;
            filterPromoters();
        } else {
            alert('Could not extract promoter name from first row.');
        }
    } else {
        alert('Could not find promoter cell in first row.');
    }
}
</script>

<style>
/* Enhanced color scheme and modern styling */
:root {
    --primary-color: #4f46e5;
    --primary-light: #6366f1;
    --primary-dark: #3730a3;
    --success-color: #059669;
    --success-light: #10b981;
    --info-color: #0891b2;
    --info-light: #06b6d4;
    --warning-color: #d97706;
    --warning-light: #f59e0b;
    --danger-color: #dc2626;
    --danger-light: #ef4444;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
}

/* Card border colors with improved gradients */
.border-left-primary {
    border-left: 4px solid var(--primary-color) !important;
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(99, 102, 241, 0.02) 100%);
}

.border-left-success {
    border-left: 4px solid var(--success-color) !important;
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.05) 0%, rgba(16, 185, 129, 0.02) 100%);
}

.border-left-info {
    border-left: 4px solid var(--info-color) !important;
    background: linear-gradient(135deg, rgba(8, 145, 178, 0.05) 0%, rgba(6, 182, 212, 0.02) 100%);
}

.border-left-warning {
    border-left: 4px solid var(--warning-color) !important;
    background: linear-gradient(135deg, rgba(217, 119, 6, 0.05) 0%, rgba(245, 158, 11, 0.02) 100%);
}

/* Enhanced card styling */
.card {
    border: 1px solid var(--gray-200);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transform: translateY(-1px);
}

.card-header {
    background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
    border-bottom: 1px solid var(--gray-200);
}

/* Improved badge colors */
.badge-primary {
    background-color: var(--primary-color) !important;
    color: white !important;
}

.badge-success {
    background-color: var(--success-color) !important;
    color: white !important;
}

.badge-info {
    background-color: var(--info-color) !important;
    color: white !important;
}

.badge-warning {
    background-color: var(--warning-color) !important;
    color: white !important;
}

.badge-danger {
    background-color: var(--danger-color) !important;
    color: white !important;
}

/* Enhanced button styling */
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(79, 70, 229, 0.3);
}

.btn-success {
    background-color: var(--success-color);
    border-color: var(--success-color);
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #047857;
    border-color: #047857;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(5, 150, 105, 0.3);
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transform: translateY(-1px);
}

.btn-outline-success {
    color: var(--success-color);
    border-color: var(--success-color);
    transition: all 0.3s ease;
}

.btn-outline-success:hover {
    background-color: var(--success-color);
    border-color: var(--success-color);
    transform: translateY(-1px);
}

/* Enhanced table styling */
.table-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%) !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(79, 70, 229, 0.05);
    transition: background-color 0.3s ease;
}

/* Sticky column with better styling */
.sticky-column {
    position: sticky;
    left: 0;
    background-color: white;
    z-index: 10;
    border-right: 2px solid var(--gray-200);
    box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
}

/* Sticky right columns for attendance table */
.sticky-column-right {
    position: sticky;
    right: 0;
    background-color: white;
    z-index: 10;
    border-left: 2px solid var(--gray-200);
    box-shadow: -2px 0 4px rgba(0, 0, 0, 0.1);
}

/* Multiple sticky right columns - Fixed positioning */
.sticky-column-right:nth-last-child(3) {
    right: 160px; /* Total column - furthest right */
    min-width: 60px;
}

.sticky-column-right:nth-last-child(2) {
    right: 80px; /* Present column - middle */
    min-width: 80px;
}

.sticky-column-right:nth-last-child(1) {
    right: 0; /* Absent column - closest to edge */
    min-width: 80px;
}

/* Ensure sticky columns have proper background */
.sticky-column-right {
    background-color: white !important;
}

/* Header sticky columns */
thead .sticky-column-right:nth-last-child(3) {
    right: 160px;
    background-color: #0d6efd !important;
}

thead .sticky-column-right:nth-last-child(2) {
    right: 80px;
    background-color: #0d6efd !important;
}

thead .sticky-column-right:nth-last-child(1) {
    right: 0;
    background-color: #0d6efd !important;
}

/* Enhanced progress bars */
.progress {
    background-color: var(--gray-200);
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    background: linear-gradient(90deg, var(--success-color) 0%, var(--success-light) 100%);
    transition: width 0.6s ease;
}

.progress-sm {
    height: 0.5rem;
}

/* Enhanced attendance checkboxes */
.attendance-check {
    transform: scale(1.3);
    accent-color: var(--success-color);
}

.attendance-check:checked {
    background-color: var(--success-color);
    border-color: var(--success-color);
}

/* Enhanced form styling */
.form-control {
    border: 1px solid var(--gray-300);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

/* Enhanced alert styling */
.alert-info {
    background: linear-gradient(135deg, rgba(8, 145, 178, 0.1) 0%, rgba(6, 182, 212, 0.05) 100%);
    border: 1px solid rgba(8, 145, 178, 0.2);
    color: var(--info-color);
}

.alert-warning {
    background: linear-gradient(135deg, rgba(217, 119, 6, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
    border: 1px solid rgba(217, 119, 6, 0.2);
    color: var(--warning-color);
}

.alert-success {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    border: 1px solid rgba(5, 150, 105, 0.2);
    color: var(--success-color);
}

/* Enhanced text colors */
.text-primary {
    color: var(--primary-color) !important;
}

.text-success {
    color: var(--success-color) !important;
}

.text-info {
    color: var(--info-color) !important;
}

.text-warning {
    color: var(--warning-color) !important;
}

.text-danger {
    color: var(--danger-color) !important;
}

.text-gray-300 {
    color: var(--gray-300) !important;
}

.text-gray-800 {
    color: var(--gray-800) !important;
}

/* Enhanced tab styling */
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-radius: 8px 8px 0 0;
    transition: all 0.3s ease;
    color: var(--gray-600);
}

.nav-tabs .nav-link:hover {
    border-color: var(--gray-200);
    color: var(--primary-color);
}

.nav-tabs .nav-link.active {
    color: var(--primary-color);
    background-color: white;
    border-color: var(--gray-200) var(--gray-200) white;
    font-weight: 600;
}

/* Enhanced table responsive */
.table-responsive {
    max-height: 500px;
    overflow-y: auto;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Enhanced icon colors */
.fa-2x.text-gray-300 {
    color: var(--gray-300) !important;
}

/* Enhanced spacing and typography */
.font-weight-bold {
    font-weight: 700 !important;
}

.font-weight-medium {
    font-weight: 500 !important;
}

/* Enhanced border radius */
.card, .btn, .form-control, .table {
    border-radius: 8px;
}

/* Enhanced shadows */
.card {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.btn {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

/* Enhanced transitions */
* {
    transition: all 0.3s ease;
}

/* Custom scrollbar */
.table-responsive::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: var(--gray-100);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: var(--gray-400);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: var(--gray-500);
}

/* Dynamic search suggestions */
.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid var(--gray-300);
    border-top: none;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-height: 200px;
    overflow-y: auto;
}

.suggestion-item {
    padding: 10px 15px;
    cursor: pointer;
    transition: all 0.2s ease;
    border-bottom: 1px solid var(--gray-100);
}

.suggestion-item:hover {
    background-color: var(--primary-color);
    color: white;
}

.suggestion-item:last-child {
    border-bottom: none;
}

/* Search highlight */
.search-highlight {
    background-color: #ffeb3b;
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: bold;
    color: var(--gray-800);
}

/* Enhanced input group */
.input-group .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.input-group-append .btn {
    border-color: var(--gray-300);
    transition: all 0.3s ease;
}

.input-group-append .btn:hover {
    background-color: var(--gray-100);
    border-color: var(--gray-400);
}

/* Sort indicator */
.sort-icon {
    transition: all 0.3s ease;
}

/* Enhanced table row animations */
tbody tr {
    transition: all 0.3s ease;
}

tbody tr:hover {
    background-color: rgba(79, 70, 229, 0.05);
    transform: translateX(5px);
}

/* Dynamic filter results animation */
#filterResults {
    transition: all 0.3s ease;
    font-weight: 500;
}

/* Enhanced button states */
.btn:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}

.btn:not(:disabled):hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* Loading states */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid var(--primary-color);
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Enhanced form positioning */
.form-group {
    position: relative;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .search-suggestions {
        position: fixed;
        top: auto;
        left: 15px;
        right: 15px;
        z-index: 1050;
    }

    .input-group {
        flex-wrap: nowrap;
    }

    .btn-group-sm {
        flex-direction: column;
    }

    .btn-group-sm .btn {
        margin-bottom: 5px;
    }
}
</style>

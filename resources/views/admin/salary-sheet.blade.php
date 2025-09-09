
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Professional Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="salary-icon me-3">
                                <i class="icon-book fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h2 class="mb-1 text-dark fw-bold">{{ $eventJob->job_name }}</h2>
                                <p class="mb-0 text-muted">Salary Sheet Management System</p>
                                <small class="text-muted">Job #{{ $eventJob->job_number }} | {{ $eventJob->client_name }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ admin_url('event-jobs') }}" class="btn btn-outline-secondary">
                                <i class="icon-arrow-left me-1"></i> Back
                            </a>
                            <button class="btn btn-outline-primary" onclick="printSalarySheet()">
                                <i class="icon-printer me-1"></i> Print
                            </button>
                            <button class="btn btn-success" onclick="exportSalarySheet()">
                                <i class="icon-download me-1"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Professional Tabs Section -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <ul class="nav nav-tabs" id="salaryTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                            <i class="icon-chart me-2"></i>
                            Overview
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="promoters-tab" data-bs-toggle="tab" data-bs-target="#promoters" type="button" role="tab">
                            <i class="icon-user me-2"></i>
                            Promoters ({{ $assignedPromoters->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="calculation-tab" data-bs-toggle="tab" data-bs-target="#calculation" type="button" role="tab">
                            <i class="icon-calculator me-2"></i>
                            Salary Calculation
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab">
                            <i class="icon-calendar me-2"></i>
                            Attendance
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                <div class="tab-content" id="salaryTabsContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <!-- Key Metrics Cards -->
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="icon-box"></i>
                                    </div>
                                    <div class="metric-content">
                                        <h3 class="metric-value">{{ $eventJob->job_number }}</h3>
                                        <p class="metric-label">Job Number</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="icon-building"></i>
                                    </div>
                                    <div class="metric-content">
                                        <h3 class="metric-value">{{ Str::limit($eventJob->client_name, 15) }}</h3>
                                        <p class="metric-label">Client</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <div class="metric-content">
                                        <h3 class="metric-value">{{ $assignedPromoters->count() }}</h3>
                                        <p class="metric-label">Promoters</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="icon-calendar"></i>
                                    </div>
                                    <div class="metric-content">
                                        <h3 class="metric-value">
                                            @if($eventJob->activation_start_date && $eventJob->activation_end_date)
                                                {{ $eventJob->activation_start_date->diffInDays($eventJob->activation_end_date) + 1 }}
                                            @else
                                                N/A
                                            @endif
                                        </h3>
                                        <p class="metric-label">Duration (Days)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detailed Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <h5 class="mb-0"><i class="icon-book me-2 text-primary"></i>Job Details</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <div class="info-item">
                                            <span class="info-label">Job Name:</span>
                                            <span class="info-value">{{ $eventJob->job_name }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Start Date:</span>
                                            <span class="info-value">
                                                {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('M d, Y') : 'Not Set' }}
                                            </span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">End Date:</span>
                                            <span class="info-value">
                                                {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('M d, Y') : 'Ongoing' }}
                                            </span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Created:</span>
                                            <span class="info-value">{{ $eventJob->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <h5 class="mb-0"><i class="icon-user me-2 text-success"></i>Personnel</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <div class="info-item">
                                            <span class="info-label">Officer:</span>
                                            <span class="info-value">{{ $eventJob->officer_name }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Reporter:</span>
                                            <span class="info-value">{{ $eventJob->reporter_officer_name }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Status:</span>
                                            <span class="info-value">
                                                <span class="badge bg-success">Active</span>
                                            </span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Last Updated:</span>
                                            <span class="info-value">{{ $eventJob->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Promoters Tab -->
                    <div class="tab-pane fade" id="promoters" role="tabpanel">
                        @if($assignedPromoters->count() > 0)
                            <!-- Header with Assign Button -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0 text-muted">Assigned Promoters ({{ $assignedPromoters->count() }})</h5>
                                <a href="{{ admin_url('event-jobs/' . $eventJob->id . '/assign-promoters') }}" class="btn btn-primary">
                                    <i class="icon-plus me-1"></i> Assign More Promoters
                                </a>
                            </div>
                            
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
                                            <th class="text-white">Coordinator Commission</th>
                                            <th class="text-white">Bank Details</th>
                                            <th class="text-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignedPromoters as $index => $assignment)
                                            <tr>
                                                <td class="fw-bold">{{ $index + 1 }}</td>
                                                <td><span class="badge bg-primary">{{ $assignment->promoter->promoter_id }}</span></td>
                                                <td class="fw-medium">{{ $assignment->promoter->promoter_name }}</td>
                                                <td>{{ $assignment->promoter->id_no }}</td>
                                                <td>{{ $assignment->promoter->phone_no }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ $assignment->coordinator->coordinator_name }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-success fw-bold">${{ number_format($assignment->promoter_salary_per_day, 2) }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-warning fw-bold">${{ number_format($assignment->supervisor_commission, 2) }}</span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $assignment->promoter->bank_name }}</small><br>
                                                    <small>{{ $assignment->promoter->account_number }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button class="btn btn-outline-primary" onclick="editPromoter({{ $assignment->promoter->id }})">
                                                            <i class="icon-edit"></i>
                                                        </button>
                                                        <button class="btn btn-outline-success" onclick="calculateSalary({{ $assignment->promoter->id }})">
                                                            <i class="icon-calculator"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="icon-user fa-3x text-muted"></i>
                                </div>
                                <h4 class="empty-state-title">No Promoters Assigned</h4>
                                <p class="empty-state-text">This event job doesn't have any promoters assigned yet.</p>
                                <a href="{{ admin_url('event-jobs/' . $eventJob->id . '/assign-promoters') }}" class="btn btn-primary">
                                    <i class="icon-plus me-1"></i> Assign Promoters
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Salary Calculation Tab -->
                    <div class="tab-pane fade" id="calculation" role="tabpanel">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="calculation-card">
                                    <div class="calculation-header">
                                        <h5 class="mb-0"><i class="icon-calculator me-2 text-primary"></i>Salary Calculation</h5>
                                    </div>
                                    <div class="calculation-body">
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
                                            <div class="calculation-actions">
                                                <button type="button" class="btn btn-primary" onclick="calculateAllSalaries()">
                                                    <i class="icon-calculator me-1"></i> Calculate All Salaries
                                                </button>
                                                <button type="button" class="btn btn-success" onclick="generateSalarySheet()">
                                                    <i class="icon-file me-1"></i> Generate Report
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="summary-card">
                                    <div class="summary-header">
                                        <h5 class="mb-0"><i class="icon-chart me-2 text-success"></i>Summary</h5>
                                    </div>
                                    <div class="summary-body" id="salary-summary">
                                        <div class="summary-placeholder">
                                            <i class="icon-info text-muted"></i>
                                            <p class="text-muted">Set parameters and calculate to see summary</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Tab -->
                    <div class="tab-pane fade" id="attendance" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="attendance-card">
                                    <div class="attendance-header">
                                        <h5 class="mb-0"><i class="icon-calendar me-2 text-primary"></i>Attendance Management</h5>
                                        <small class="text-muted">Event Duration: {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('M d, Y') : 'Not set' }} - {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('M d, Y') : 'Not set' }}</small>
                                        <div class="mt-2">
                                            <small class="text-info">Debug: Event ID: {{ $eventJob->id }}, Assigned Promoters: {{ $assignedPromoters->count() }}</small>
                                        </div>
                                    </div>
                                    <div class="attendance-body">
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
                                            
                                            <!-- Filter and Search Bar -->
                                            <div class="row mb-3">
                                                <div class="col-md-8">
                                                    <div class="attendance-filter">
                                                        <h6 class="text-primary mb-2">Filter Promoters</h6>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="icon-search"></i>
                                                            </span>
                                                            <input type="text" 
                                                                   class="form-control" 
                                                                   id="promoterFilter" 
                                                                   placeholder="Search by promoter name or ID..."
                                                                   onkeyup="filterPromoters()">
                                                            <button class="btn btn-outline-secondary" onclick="clearFilter()">
                                                                <i class="icon-times"></i> Clear
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="attendance-save">
                                                        <h6 class="text-success mb-2">Save Changes</h6>
                                                        <button class="btn btn-success btn-sm" onclick="saveAllAttendance()">
                                                            <i class="icon-save me-1"></i> Save All Changes
                                                        </button>
                                                        <div class="mt-1">
                                                            <small class="text-muted" id="saveStatus">All changes auto-saved</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="attendance-summary">
                                                        <h6 class="text-primary">Event Summary</h6>
                                                        <p class="mb-1"><strong>Total Days:</strong> {{ count($days) }} days</p>
                                                        <p class="mb-1"><strong>Start Date:</strong> {{ $startDate->format('M d, Y (l)') }}</p>
                                                        <p class="mb-0"><strong>End Date:</strong> {{ $endDate->format('M d, Y (l)') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="attendance-actions">
                                                        <h6 class="text-success">Quick Actions</h6>
                                                        <button class="btn btn-outline-primary btn-sm me-2" onclick="markAllPresent()">
                                                            <i class="icon-check me-1"></i> Mark All Present
                                                        </button>
                                                        <button class="btn btn-outline-success btn-sm me-2" onclick="exportAttendance()">
                                                            <i class="icon-download me-1"></i> Export
                                                        </button>
                                                        <button class="btn btn-outline-info btn-sm" onclick="printAttendance()">
                                                            <i class="icon-printer me-1"></i> Print
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($assignedPromoters->count() > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-bordered attendance-table">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th class="text-white sticky-column-left">Promoter</th>
                                                                @foreach($days as $day)
                                                                    <th class="text-white text-center" style="min-width: 80px;">
                                                                        {{ $day->format('M d') }}<br>
                                                                        <small>{{ $day->format('D') }}</small>
                                                                    </th>
                                                                @endforeach
                                                                <th class="text-white text-center sticky-column-right-3">Total Days</th>
                                                                <th class="text-white text-center sticky-column-right-1">Present Days</th>
                                                                <th class="text-white text-center sticky-column-right-2">Absent Days</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($assignedPromoters as $assignment)
                                                                <tr>
                                                                    <td class="fw-medium sticky-column-left">
                                                                        <div>
                                                                            <strong>{{ $assignment->promoter->promoter_name }}</strong><br>
                                                                            <small class="text-muted">{{ $assignment->promoter->promoter_id }}</small>
                                                                        </div>
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
                                                                            <div class="attendance-checkbox">
                                                                                <input type="checkbox" 
                                                                                       class="form-check-input attendance-check" 
                                                                                       data-promoter="{{ $assignment->promoter->id }}" 
                                                                                       data-date="{{ $dayKey }}"
                                                                                       {{ $isPresent ? 'checked' : '' }}
                                                                                       onchange="updateAttendance(this)">
                                                                                <label class="form-check-label">
                                                                                    @if($isPresent)
                                                                                        <i class="icon-check text-success"></i>
                                                                                    @else
                                                                                        <i class="icon-times text-danger"></i>
                                                                                    @endif
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    @endforeach
                                                                    <td class="text-center fw-bold sticky-column-right-3">{{ count($days) }}</td>
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
                                                                    <td class="text-center sticky-column-right-1">
                                                                        <span class="badge bg-success" id="present-{{ $assignment->promoter->id }}">{{ $presentCount }}</span>
                                                                    </td>
                                                                    <td class="text-center sticky-column-right-2">
                                                                        <span class="badge bg-danger" id="absent-{{ $assignment->promoter->id }}">{{ $absentCount }}</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="empty-state">
                                                    <div class="empty-state-icon">
                                                        <i class="icon-user fa-3x text-muted"></i>
                                                    </div>
                                                    <h4 class="empty-state-title">No Promoters Assigned</h4>
                                                    <p class="empty-state-text">Please assign promoters first to manage attendance.</p>
                                                    <a href="{{ admin_url('event-jobs/' . $eventJob->id . '/assign-promoters') }}" class="btn btn-primary">
                                                        <i class="icon-plus me-1"></i> Assign Promoters
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            <div class="empty-state">
                                                <div class="empty-state-icon">
                                                    <i class="icon-calendar fa-3x text-muted"></i>
                                                </div>
                                                <h4 class="empty-state-title">Event Dates Not Set</h4>
                                                <p class="empty-state-text">Please set the event start and end dates to manage attendance.</p>
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
    </div>
</div>

<script>
function editPromoter(promoterId) {
    alert('Edit promoter functionality will be implemented here. Promoter ID: ' + promoterId);
}

function calculateSalary(promoterId) {
    alert('Calculate salary for promoter ID: ' + promoterId);
}

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
        <div class="summary-item">
            <div class="summary-label">Total Promoters</div>
            <div class="summary-value">${totalPromoters}</div>
        </div>
        <div class="summary-item">
            <div class="summary-label">Total Days</div>
            <div class="summary-value">${totalDays}</div>
        </div>
        <div class="summary-item">
            <div class="summary-label">Base Salary</div>
            <div class="summary-value">Rs. ${totalSalary.toLocaleString()}</div>
        </div>
        <div class="summary-item">
            <div class="summary-label">Overtime</div>
            <div class="summary-value">Rs. ${totalOvertime.toLocaleString()}</div>
        </div>
        <div class="summary-item">
            <div class="summary-label">Bonus</div>
            <div class="summary-value">Rs. ${totalBonus.toLocaleString()}</div>
        </div>
        <div class="summary-item total">
            <div class="summary-label">Grand Total</div>
            <div class="summary-value">Rs. ${grandTotal.toLocaleString()}</div>
        </div>
    `;

    document.getElementById('salary-summary').innerHTML = summaryHtml;
}

function generateSalarySheet() {
    alert('Salary sheet generation functionality will be implemented here');
}

function exportSalarySheet() {
    alert('Export functionality will be implemented here');
}

function printSalarySheet() {
    window.print();
}

function markAllPresent() {
    if (confirm('Are you sure you want to mark all promoters as present for all days?')) {
        const eventId = {{ $eventJob->id }};
        
        fetch('{{ admin_url("event-jobs/mark-all-present") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                event_id: eventId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update all checkboxes visually
                const checkboxes = document.querySelectorAll('.attendance-check');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    const label = checkbox.nextElementSibling;
                    label.innerHTML = '<i class="icon-check text-success"></i>';
                });
                
                // Update all attendance counts
                const promoterIds = [...new Set(Array.from(checkboxes).map(cb => cb.dataset.promoter))];
                promoterIds.forEach(promoterId => {
                    updateAttendanceCounts(promoterId);
                });
                
                alert('All promoters marked as present successfully!');
            } else {
                alert('Failed to mark all present: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to mark all present. Please try again.');
        });
    }
}

function exportAttendance() {
    alert('Export attendance functionality will be implemented here');
}

function printAttendance() {
    const attendanceTable = document.querySelector('.attendance-table');
    if (attendanceTable) {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Attendance Report - {{ $eventJob->job_name }}</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
                        th { background-color: #007bff; color: white; }
                    </style>
                </head>
                <body>
                    <h2>Attendance Report - {{ $eventJob->job_name }}</h2>
                    <p><strong>Event Duration:</strong> {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('M d, Y') : 'Not set' }} - {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('M d, Y') : 'Not set' }}</p>
                    ${attendanceTable.outerHTML}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
}

function updateAttendance(checkbox) {
    const promoterId = checkbox.dataset.promoter;
    const eventId = {{ $eventJob->id }};
    const date = checkbox.dataset.date;
    const status = checkbox.checked ? 'attend' : 'absent';
    
    console.log('Updating attendance:', { promoterId, eventId, date, status });
    
    // Update visual feedback immediately
    const label = checkbox.nextElementSibling;
    if (checkbox.checked) {
        label.innerHTML = '<i class="icon-check text-success"></i>';
    } else {
        label.innerHTML = '<i class="icon-times text-danger"></i>';
    }
    
    // Send AJAX request to save attendance
    fetch('{{ admin_url("event-jobs/update-attendance") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            promoter_id: promoterId,
            event_id: eventId,
            date: date,
            status: status
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            updateAttendanceCounts(promoterId);
            console.log('Attendance updated successfully');
        } else {
            // Revert checkbox if save failed
            checkbox.checked = !checkbox.checked;
            if (checkbox.checked) {
                label.innerHTML = '<i class="icon-check text-success"></i>';
            } else {
                label.innerHTML = '<i class="icon-times text-danger"></i>';
            }
            alert('Failed to update attendance: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Revert checkbox if save failed
        checkbox.checked = !checkbox.checked;
        if (checkbox.checked) {
            label.innerHTML = '<i class="icon-check text-success"></i>';
        } else {
            label.innerHTML = '<i class="icon-times text-danger"></i>';
        }
        alert('Failed to update attendance. Please try again.');
    });
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

// Attendance data is now loaded server-side, no need for AJAX loading

function filterPromoters() {
    const filterValue = document.getElementById('promoterFilter').value.toLowerCase();
    const tableRows = document.querySelectorAll('.attendance-table tbody tr');
    
    tableRows.forEach(row => {
        const promoterName = row.querySelector('td:first-child strong').textContent.toLowerCase();
        const promoterId = row.querySelector('td:first-child small').textContent.toLowerCase();
        
        if (promoterName.includes(filterValue) || promoterId.includes(filterValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update save status
    updateSaveStatus('Filtered promoters');
}

function clearFilter() {
    document.getElementById('promoterFilter').value = '';
    const tableRows = document.querySelectorAll('.attendance-table tbody tr');
    
    tableRows.forEach(row => {
        row.style.display = '';
    });
    
    updateSaveStatus('Filter cleared');
}

function saveAllAttendance() {
    const saveButton = document.querySelector('button[onclick="saveAllAttendance()"]');
    const originalText = saveButton.innerHTML;
    
    // Show loading state
    saveButton.innerHTML = '<i class="icon-spinner fa-spin me-1"></i> Saving...';
    saveButton.disabled = true;
    
    // Get all checkboxes
    const checkboxes = document.querySelectorAll('.attendance-check');
    const eventId = {{ $eventJob->id }};
    let savePromises = [];
    
    checkboxes.forEach(checkbox => {
        const promoterId = checkbox.dataset.promoter;
        const date = checkbox.dataset.date;
        const status = checkbox.checked ? 'attend' : 'absent';
        
        const savePromise = fetch('{{ admin_url("event-jobs/update-attendance") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                promoter_id: promoterId,
                event_id: eventId,
                date: date,
                status: status
            })
        });
        
        savePromises.push(savePromise);
    });
    
    // Wait for all saves to complete
    Promise.all(savePromises)
    .then(responses => {
        const allSuccessful = responses.every(response => response.ok);
        
        if (allSuccessful) {
            updateSaveStatus('All changes saved successfully!', 'success');
        } else {
            updateSaveStatus('Some changes failed to save', 'error');
        }
    })
    .catch(error => {
        console.error('Error saving attendance:', error);
        updateSaveStatus('Error saving changes', 'error');
    })
    .finally(() => {
        // Reset button state
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
}

function updateSaveStatus(message, type = 'info') {
    const statusElement = document.getElementById('saveStatus');
    statusElement.textContent = message;
    
    // Remove existing classes
    statusElement.classList.remove('text-success', 'text-danger', 'text-info', 'text-muted');
    
    // Add appropriate class
    if (type === 'success') {
        statusElement.classList.add('text-success');
    } else if (type === 'error') {
        statusElement.classList.add('text-danger');
    } else if (type === 'info') {
        statusElement.classList.add('text-info');
    } else {
        statusElement.classList.add('text-muted');
    }
}

$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Initialize attendance counts for all promoters
    initializeAttendanceCounts();
});

function initializeAttendanceCounts() {
    // Get all unique promoter IDs from checkboxes
    const promoterIds = [...new Set(Array.from(document.querySelectorAll('.attendance-check')).map(cb => cb.dataset.promoter))];
    
    // Update counts for each promoter
    promoterIds.forEach(promoterId => {
        updateAttendanceCounts(promoterId);
    });
}
</script>

<style>
/* Professional UI Styles */
.salary-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Promoter Table Header Styling */
.table-primary {
    background-color: #007bff !important;
}

.table-primary th {
    background-color: #007bff !important;
    color: white !important;
    font-weight: 600;
    border-color: #0056b3 !important;
}

.table-primary th.text-white {
    color: white !important;
}

/* Attendance Tab Styling */
.attendance-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.attendance-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px;
    border-bottom: 1px solid #dee2e6;
}

.attendance-body {
    padding: 20px;
}

.attendance-summary {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.attendance-actions {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #28a745;
}

.attendance-table {
    font-size: 0.9rem;
}

.attendance-table th {
    font-size: 0.8rem;
    padding: 8px 4px;
    vertical-align: middle;
}

.attendance-table td {
    padding: 8px 4px;
    vertical-align: middle;
}

.attendance-checkbox {
    display: flex;
    align-items: center;
    justify-content: center;
}

.attendance-checkbox input[type="checkbox"] {
    margin: 0;
    transform: scale(1.2);
}

.attendance-checkbox label {
    margin: 0;
    cursor: pointer;
}

.attendance-checkbox i {
    font-size: 1.2rem;
}

/* Filter and Save Styling */
.attendance-filter {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.attendance-save {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #28a745;
}

.attendance-filter .input-group-text {
    background-color: #e9ecef;
    border-color: #ced4da;
}

.attendance-filter .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

#saveStatus {
    font-size: 0.8rem;
    font-weight: 500;
}

/* Sticky columns for attendance table */
.sticky-column-left {
    position: sticky;
    left: 0;
    background-color: #007bff !important;
    z-index: 10;
    border-right: 2px solid #0056b3 !important;
    min-width: 150px;
}

.sticky-column-right-3 {
    position: sticky;
    right: 160px;
    background-color: #007bff !important;
    z-index: 10;
    border-left: 2px solid #0056b3 !important;
}

.sticky-column-right-1 {
    position: sticky;
    right: 80px;
    background-color: #007bff !important;
    z-index: 10;
    border-left: 2px solid #0056b3 !important;
}

.sticky-column-right-2 {
    position: sticky;
    right: 0;
    background-color: #007bff !important;
    z-index: 10;
    border-left: 2px solid #0056b3 !important;
}

/* Ensure sticky columns work in table */
.attendance-table {
    position: relative;
}

.attendance-table thead th.sticky-column-left,
.attendance-table thead th.sticky-column-right-3,
.attendance-table thead th.sticky-column-right-1,
.attendance-table thead th.sticky-column-right-2 {
    background-color: #007bff !important;
    color: white !important;
}

.attendance-table tbody td.sticky-column-left {
    background-color: white !important;
    border-right: 2px solid #0056b3 !important;
}

.attendance-table tbody td.sticky-column-right-3,
.attendance-table tbody td.sticky-column-right-1,
.attendance-table tbody td.sticky-column-right-2 {
    background-color: white !important;
    border-left: 2px solid #0056b3 !important;
}

.metric-card {
    background: #f5f5f5;
    border: 1px solid #cfcfcf;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.metric-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border-color: #dee2e6;
}

.metric-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #924f89 0%, #3093f6 100%);
}

.metric-icon {
    font-size: 1.5rem;
    color: #6c757d !important;
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.metric-content {
    flex: 1;
}

.metric-value {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 4px;
    color: #212529 !important;
    line-height: 1.2;
}

.metric-label {
    font-size: 0.875rem;
    color: #6c757d !important;
    margin: 0;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.info-card-header {
    background: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #e9ecef;
}

.info-card-body {
    padding: 20px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #6c757d !important;
}

.info-value {
    font-weight: 500;
    color: #212529 !important;
}

.calculation-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.summary-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: fit-content;
}

.calculation-header, .summary-header {
    background: #f8f9fa;
    padding: 12px 15px;
    border-bottom: 1px solid #e9ecef;
}

.calculation-body, .summary-body {
    padding: 15px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #495057 !important;
    margin-bottom: 8px;
}

.calculation-actions {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state-icon {
    margin-bottom: 20px;
}

.empty-state-title {
    color: #6c757d;
    margin-bottom: 10px;
}

.empty-state-text {
    color: #adb5bd;
    margin-bottom: 30px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-item.total {
    background: #f8f9fa;
    margin: 10px -20px -20px -20px;
    padding: 15px 20px;
    border-radius: 0 0 15px 15px;
    font-weight: bold;
    color: #28a745;
}

.summary-label {
    font-weight: 500;
    color: #6c757d !important;
}

.summary-value {
    font-weight: 600;
    color: #212529 !important;
}

.summary-placeholder {
    text-align: left;
    padding: 15px 10px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
}

.summary-placeholder i {
    font-size: 1.2rem;
    margin: 0;
    color: #6c757d !important;
}

.summary-placeholder p {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d !important;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}

/* Print styles */
@media print {
    .btn-group, .nav-pills, .btn {
        display: none !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }

    .tab-content .tab-pane {
        display: block !important;
    }
}

/* Additional color fixes */
.card-body {
    color: #212529 !important;
}

.card-body h1, .card-body h2, .card-body h3, .card-body h4, .card-body h5, .card-body h6 {
    color: #212529 !important;
}

.card-body p, .card-body span, .card-body div {
    color: inherit;
}

.table td, .table th {
    color: #212529 !important;
}

.btn {
    color: inherit !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .metric-card {
        margin-bottom: 15px;
    }

    .btn-group {
        flex-direction: column;
    }

    .btn-group .btn {
        margin-bottom: 5px;
    }
}
</style>

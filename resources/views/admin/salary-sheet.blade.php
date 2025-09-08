
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

$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
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

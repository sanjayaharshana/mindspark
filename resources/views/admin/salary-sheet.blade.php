
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-money"></i> Salary Sheet - {{ $eventJob->job_name }}
                </h3>
                <div class="card-tools">
                    <a href="{{ admin_url('event-jobs') }}" class="btn btn-tool">
                        <i class="fa fa-arrow-left"></i> Back to Event Jobs
                    </a>
                    <button class="btn btn-tool" onclick="printSalarySheet()">
                        <i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>

            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item">
                        <a href="#overview" class="nav-link active" aria-controls="overview" role="tab" data-toggle="tab">
                            <i class="fa fa-info-circle"></i> Overview
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a href="#promoters" class="nav-link" aria-controls="promoters" role="tab" data-toggle="tab">
                            <i class="fa fa-users"></i> Promoters ({{ $promoters->count() }})
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a href="#salary-calculation" class="nav-link" aria-controls="salary-calculation" role="tab" data-toggle="tab">
                            <i class="fa fa-calculator"></i> Salary Calculation
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content mt-3">
                    <!-- Overview Tab -->
                    <div role="tabpanel" class="tab-pane active" id="overview">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box bg-info">
                                    <span class="info-box-icon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Job Number</span>
                                        <span class="info-box-number">{{ $eventJob->job_number }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Client Name</span>
                                        <span class="info-box-number">{{ $eventJob->client_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box bg-warning">
                                    <span class="info-box-icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Start Date</span>
                                        <span class="info-box-number">
                                            {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('Y-m-d') : 'Not Set' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-danger">
                                    <span class="info-box-icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">End Date</span>
                                        <span class="info-box-number">
                                            {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('Y-m-d') : 'Ongoing' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box bg-primary">
                                    <span class="info-box-icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Officer Name</span>
                                        <span class="info-box-number">{{ $eventJob->officer_name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-secondary">
                                    <span class="info-box-icon">
                                        <i class="fa fa-user-secret"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Reporter Officer</span>
                                        <span class="info-box-number">{{ $eventJob->reporter_officer_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Job Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="description-block">
                                                    <span class="description-percentage text-green">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                    <h5 class="description-header">{{ $promoters->count() }}</h5>
                                                    <span class="description-text">Total Promoters</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="description-block">
                                                    <span class="description-percentage text-blue">
                                                        <i class="fa fa-calendar-o"></i>
                                                    </span>
                                                    <h5 class="description-header">
                                                        @if($eventJob->activation_start_date && $eventJob->activation_end_date)
                                                            {{ $eventJob->activation_start_date->diffInDays($eventJob->activation_end_date) + 1 }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </h5>
                                                    <span class="description-text">Duration (Days)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="description-block">
                                                    <span class="description-percentage text-yellow">
                                                        <i class="fa fa-clock-o"></i>
                                                    </span>
                                                    <h5 class="description-header">{{ $eventJob->created_at->diffForHumans() }}</h5>
                                                    <span class="description-text">Created</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="description-block">
                                                    <span class="description-percentage text-red">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                                    <h5 class="description-header">Rs. 0</h5>
                                                    <span class="description-text">Total Salary</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Promoters Tab -->
                    <div role="tabpanel" class="tab-pane" id="promoters">
                        @if($promoters->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Promoter ID</th>
                                            <th>Name</th>
                                            <th>ID Number</th>
                                            <th>Phone Number</th>
                                            <th>Bank Name</th>
                                            <th>Branch</th>
                                            <th>Account Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($promoters as $index => $promoter)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $promoter->promoter_id }}</td>
                                                <td>{{ $promoter->promoter_name }}</td>
                                                <td>{{ $promoter->id_no }}</td>
                                                <td>{{ $promoter->phone_no }}</td>
                                                <td>{{ $promoter->bank_name }}</td>
                                                <td>{{ $promoter->bank_branch_name }}</td>
                                                <td>{{ $promoter->account_number }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" onclick="editPromoter({{ $promoter->id }})">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-success" onclick="calculateSalary({{ $promoter->id }})">
                                                        <i class="fa fa-calculator"></i> Calculate
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i> No promoters assigned to this event job yet.
                            </div>
                        @endif
                    </div>

                    <!-- Salary Calculation Tab -->
                    <div role="tabpanel" class="tab-pane" id="salary-calculation">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Salary Calculation Settings</h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="salary-form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="daily_rate">Daily Rate (Rs.)</label>
                                                        <input type="number" class="form-control" id="daily_rate" name="daily_rate" placeholder="Enter daily rate">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="overtime_rate">Overtime Rate (Rs.)</label>
                                                        <input type="number" class="form-control" id="overtime_rate" name="overtime_rate" placeholder="Enter overtime rate">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bonus">Bonus (Rs.)</label>
                                                        <input type="number" class="form-control" id="bonus" name="bonus" placeholder="Enter bonus amount">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-primary" onclick="calculateAllSalaries()">
                                                        <i class="fa fa-calculator"></i> Calculate All Salaries
                                                    </button>
                                                    <button type="button" class="btn btn-success" onclick="generateSalarySheet()">
                                                        <i class="fa fa-file-excel-o"></i> Generate Salary Sheet
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Salary Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="salary-summary">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle"></i> Please set the salary calculation parameters and click "Calculate All Salaries" to see the summary.
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

    var totalPromoters = {{ $promoters->count() }};
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
            <div class="col-md-3">
                <div class="description-block">
                    <span class="description-percentage text-green">
                        <i class="fa fa-users"></i>
                    </span>
                    <h5 class="description-header">${totalPromoters}</h5>
                    <span class="description-text">Promoters</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="description-block">
                    <span class="description-percentage text-blue">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <h5 class="description-header">${totalDays}</h5>
                    <span class="description-text">Days</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="description-block">
                    <span class="description-percentage text-yellow">
                        <i class="fa fa-money"></i>
                    </span>
                    <h5 class="description-header">Rs. ${totalSalary.toLocaleString()}</h5>
                    <span class="description-text">Base Salary</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="description-block">
                    <span class="description-percentage text-red">
                        <i class="fa fa-money"></i>
                    </span>
                    <h5 class="description-header">Rs. ${grandTotal.toLocaleString()}</h5>
                    <span class="description-text">Total Amount</span>
                </div>
            </div>
        </div>
    `;

    document.getElementById('salary-summary').innerHTML = summaryHtml;
}

function generateSalarySheet() {
    alert('Salary sheet generation functionality will be implemented here');
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
/* Print styles */
@media print {
    .card-tools, .nav-tabs, .btn {
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

/* Custom styling */
.info-box {
    margin-bottom: 15px;
}

.description-block {
    text-align: center;
    padding: 15px;
}

.description-percentage {
    font-size: 24px;
    margin-bottom: 10px;
}

.description-header {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 5px;
}

.description-text {
    font-size: 14px;
    color: #666;
}
</style>

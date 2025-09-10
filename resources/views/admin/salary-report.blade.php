
<body>


    <div class="container">
        <!-- Back Button -->
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('admin.event-jobs.salary-sheet', $eventJob->id) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Salary Sheet
                </a>
            </div>
        </div>

        <!-- Summary -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $totalPromoters }}</h5>
                        <p class="card-text">Total Promoters</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-info">{{ $totalDays }}</h5>
                        <p class="card-text">Event Duration (Days)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Rs. {{ number_format($totalSalary, 2) }}</h5>
                        <p class="card-text">Total Salary (Based on Present Days)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Rs. {{ number_format($grandTotal, 2) }}</h5>
                        <p class="card-text">Grand Total</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Information -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Event Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Job Number:</strong> {{ $eventJob->job_number }}</p>
                        <p><strong>Job Name:</strong> {{ $eventJob->job_name }}</p>
                        <p><strong>Client:</strong> {{ $eventJob->client_name }}</p>
                        <p><strong>Officer:</strong> {{ $eventJob->officer_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Start Date:</strong> {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('M d, Y') : 'Not Set' }}</p>
                        <p><strong>End Date:</strong> {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('M d, Y') : 'Not Set' }}</p>
                        <p><strong>Duration:</strong> {{ $totalDays }} days</p>
                        <p><strong>Report Date:</strong> {{ now()->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promoter Details -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Promoter Details & Salary Breakdown</h5>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.event-jobs.salary-report.print', $eventJob->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-print"></i> Print Report
                    </a>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                    <a href="{{ route('admin.event-jobs.commission-sheet', $eventJob->id) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-user-tie"></i> Commission Sheet
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($assignedPromoters->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="salaryReportTable">
                            <thead class="table-dark">
                                <tr>
                                    <th rowspan="2" class="text-center align-middle">#</th>
                                    <th rowspan="2" class="text-center align-middle">Promoter ID</th>
                                    <th rowspan="2" class="text-center align-middle">Name</th>
                                    <th rowspan="2" class="text-center align-middle">Phone</th>
                                    <th rowspan="2" class="text-center align-middle">Coordinator</th>
                                    <th rowspan="2" class="text-center align-middle">Daily Salary</th>
                                    <th rowspan="2" class="text-center align-middle">Commission</th>
                                    @if($totalDays > 0)
                                        <th colspan="3" class="text-center">Attendance Summary</th>
                                    @endif
                                    <th rowspan="2" class="text-center align-middle">Total Salary</th>
                                    <th rowspan="2" class="text-center align-middle">Total Commission</th>
                                    <th rowspan="2" class="text-center align-middle">Subtotal</th>
                                </tr>
                                @if($totalDays > 0)
                                    <tr>
                                        <th class="text-center">Present Days</th>
                                        <th class="text-center">Absent Days</th>
                                        <th class="text-center">Total Days</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach($assignedPromoters as $index => $assignment)
                                    @php
                                        // Calculate attendance for this promoter first
                                        $presentDays = 0;
                                        $absentDays = 0;
                                        if (isset($attendanceData[$assignment->promoter_id])) {
                                            $promoterAttendance = $attendanceData[$assignment->promoter_id];
                                            $presentDays = $promoterAttendance->where('status', 'attend')->count();
                                            $absentDays = $promoterAttendance->where('status', 'absent')->count();
                                        }
                                        
                                        // Calculate salary and commission based on present days only
                                        $promoterTotalSalary = $assignment->promoter_salary_per_day * $presentDays;
                                        $coordinatorTotalCommission = $assignment->supervisor_commission * $presentDays;
                                        $subtotal = $promoterTotalSalary + $coordinatorTotalCommission;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center fw-bold">{{ $assignment->promoter->promoter_id }}</td>
                                        <td class="fw-bold">{{ $assignment->promoter->promoter_name }}</td>
                                        <td class="text-center">{{ $assignment->promoter->phone_no ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $assignment->coordinator->coordinator_name ?? 'N/A' }}</td>
                                        <td class="text-center text-primary fw-bold">Rs. {{ number_format($assignment->promoter_salary_per_day, 2) }}</td>
                                        <td class="text-center text-info fw-bold">Rs. {{ number_format($assignment->supervisor_commission, 2) }}</td>
                                        @if($totalDays > 0)
                                            <td class="text-center text-success fw-bold">{{ $presentDays }}</td>
                                            <td class="text-center text-danger fw-bold">{{ $absentDays }}</td>
                                            <td class="text-center fw-bold">{{ $totalDays }}</td>
                                        @endif
                                        <td class="text-center text-success fw-bold">Rs. {{ number_format($promoterTotalSalary, 2) }}</td>
                                        <td class="text-center text-warning fw-bold">Rs. {{ number_format($coordinatorTotalCommission, 2) }}</td>
                                        <td class="text-center fw-bold bg-light">Rs. {{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-secondary">
                                <tr>
                                    <td colspan="{{ $totalDays > 0 ? '7' : '6' }}" class="text-end fw-bold fs-5">TOTALS:</td>
                                    @if($totalDays > 0)
                                        <td class="text-center text-success fw-bold fs-5">{{ $assignedPromoters->sum(function($assignment) use ($attendanceData) { return isset($attendanceData[$assignment->promoter_id]) ? $attendanceData[$assignment->promoter_id]->where('status', 'attend')->count() : 0; }) }}</td>
                                        <td class="text-center text-danger fw-bold fs-5">{{ $assignedPromoters->sum(function($assignment) use ($attendanceData) { return isset($attendanceData[$assignment->promoter_id]) ? $attendanceData[$assignment->promoter_id]->where('status', 'absent')->count() : 0; }) }}</td>
                                        <td class="text-center fw-bold fs-5">{{ $totalDays * $assignedPromoters->count() }}</td>
                                    @endif
                                    <td class="text-center text-success fw-bold fs-5">Rs. {{ number_format($totalSalary, 2) }}</td>
                                    <td class="text-center text-warning fw-bold fs-5">Rs. {{ number_format($totalCommission, 2) }}</td>
                                    <td class="text-center fw-bold fs-5 bg-primary text-white">Rs. {{ number_format($grandTotal, 2) }}</td>
                                </tr>
                                <tr class="table-info">
                                    <td colspan="{{ $totalDays > 0 ? '10' : '9' }}" class="text-center fw-bold fs-6 text-primary">
                                        <i class="fas fa-info-circle"></i> 
                                        Salary calculations are based on actual present days only
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-users fa-3x mb-3"></i>
                            <h5>No promoters assigned to this event</h5>
                            <p>Please assign promoters to this event to generate the salary report.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Salary Settings -->
        @if($eventJob->default_salary_promoter || $eventJob->default_commission_coordinator || $eventJob->salary_rules || $eventJob->special_note)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Salary Settings & Rules</h5>
            </div>
            <div class="card-body">
                @if($eventJob->default_salary_promoter)
                    <p><strong>Default Promoter Salary:</strong> Rs. {{ number_format($eventJob->default_salary_promoter, 2) }} per day</p>
                @endif
                @if($eventJob->default_commission_coordinator)
                    <p><strong>Default Coordinator Commission:</strong> Rs. {{ number_format($eventJob->default_commission_coordinator, 2) }} per day</p>
                @endif
                @if($eventJob->salary_rules)
                    <p><strong>Salary Rules:</strong></p>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($eventJob->salary_rules)) !!}
                    </div>
                @endif
                @if($eventJob->special_note)
                    <p><strong>Special Notes:</strong></p>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($eventJob->special_note)) !!}
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="text-center text-muted py-3 no-print">
            <small>Generated on {{ now()->format('M d, Y \a\t H:i A') }} | MindSpark Event Management System</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <style>
        @media print {
            .no-print { display: none !important; }
            .btn-group { display: none !important; }
            .card { border: 1px solid #000 !important; }
            .table { font-size: 12px !important; }
            .table th, .table td { padding: 4px !important; }
        }

        .table th {
            background-color: #343a40 !important;
            color: white !important;
            font-weight: bold !important;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1) !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .text-primary { color: #0d6efd !important; }
        .text-success { color: #198754 !important; }
        .text-warning { color: #ffc107 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-info { color: #0dcaf0 !important; }
    </style>

    <script>
        function exportToExcel() {
            const table = document.getElementById('salaryReportTable');
            const wb = XLSX.utils.table_to_book(table, {sheet: "Salary Report"});

            // Add event information to the sheet
            const ws = wb.Sheets["Salary Report"];

            // Add header information
            const headerData = [
                ['SALARY REPORT'],
                ['Job Number: {{ $eventJob->job_number }}'],
                ['Job Name: {{ $eventJob->job_name }}'],
                ['Client: {{ $eventJob->client_name }}'],
                ['Period: {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format("M d, Y") : "Not Set" }} - {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format("M d, Y") : "Not Set" }}'],
                ['Generated: {{ now()->format("M d, Y \a\t H:i A") }}'],
                ['']
            ];

            // Insert header rows
            XLSX.utils.sheet_add_aoa(ws, headerData, { origin: "A1" });

            // Move table data down
            const range = XLSX.utils.decode_range(ws['!ref']);
            const newRange = XLSX.utils.encode_range({
                s: { r: range.s.r + 7, c: range.s.c },
                e: { r: range.e.r + 7, c: range.e.c }
            });
            ws['!ref'] = newRange;

            // Save file
            const fileName = 'Salary_Report_{{ $eventJob->job_number }}_{{ now()->format("Y-m-d") }}.xlsx';
            XLSX.writeFile(wb, fileName);
        }

        // Add print styles
        window.addEventListener('beforeprint', function() {
            document.body.classList.add('printing');
        });

        window.addEventListener('afterprint', function() {
            document.body.classList.remove('printing');
        });
    </script>
</body>
</html>

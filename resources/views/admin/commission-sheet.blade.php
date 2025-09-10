
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
                        <h5 class="card-title text-primary">{{ $totalCoordinators }}</h5>
                        <p class="card-text">Total Coordinators</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-info">{{ $totalPromoters }}</h5>
                        <p class="card-text">Total Promoters</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $totalDays }}</h5>
                        <p class="card-text">Event Duration (Days)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Rs. {{ number_format($totalCommission, 2) }}</h5>
                        <p class="card-text">Total Commission</p>
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

        <!-- Coordinator Commission Details -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Coordinator Commission Breakdown</h5>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Report
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="exportToExcel()">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if(count($coordinatorCommissions) > 0)
                    @foreach($coordinatorCommissions as $coordinatorId => $coordinatorData)
                        <div class="mb-5">
                            <!-- Coordinator Header -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0">
                                                <i class="fas fa-user-tie"></i>
                                                {{ $coordinatorData['coordinator_name'] }}
                                                <span class="badge bg-light text-dark ms-2">{{ $coordinatorData['coordinator_id'] }}</span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p><strong>Phone:</strong> {{ $coordinatorData['phone_no'] }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p><strong>Bank:</strong> {{ $coordinatorData['bank_name'] }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p><strong>Branch:</strong> {{ $coordinatorData['bank_branch'] }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p><strong>Account:</strong> {{ $coordinatorData['account_number'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Promoters Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Promoter ID</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Daily Commission</th>
                                            <th class="text-center">Present Days</th>
                                            <th class="text-center">Absent Days</th>
                                            <th class="text-center">Total Days</th>
                                            <th class="text-center">Commission Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coordinatorData['promoters'] as $index => $promoter)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td class="text-center fw-bold">{{ $promoter['promoter_id'] }}</td>
                                                <td class="fw-bold">{{ $promoter['promoter_name'] }}</td>
                                                <td class="text-center">{{ $promoter['phone_no'] }}</td>
                                                <td class="text-center text-primary fw-bold">Rs. {{ number_format($promoter['daily_commission'], 2) }}</td>
                                                <td class="text-center text-success fw-bold">{{ $promoter['present_days'] }}</td>
                                                <td class="text-center text-danger fw-bold">{{ $promoter['absent_days'] }}</td>
                                                <td class="text-center fw-bold">{{ $promoter['total_days'] }}</td>
                                                <td class="text-center text-warning fw-bold bg-light">Rs. {{ number_format($promoter['commission_amount'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold fs-5">COORDINATOR TOTALS:</td>
                                            <td class="text-center text-primary fw-bold fs-5">-</td>
                                            <td class="text-center text-success fw-bold fs-5">{{ $coordinatorData['total_present_days'] }}</td>
                                            <td class="text-center text-danger fw-bold fs-5">{{ $coordinatorData['total_absent_days'] ?? 0 }}</td>
                                            <td class="text-center fw-bold fs-5">{{ count($coordinatorData['promoters']) * $totalDays }}</td>
                                            <td class="text-center fw-bold fs-5 bg-primary text-white">Rs. {{ number_format($coordinatorData['total_commission'], 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <!-- Grand Total -->
                    <div class="card border-success">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-calculator"></i>
                                Grand Total Commission Summary
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <h6 class="text-muted">Total Coordinators</h6>
                                    <h4 class="text-primary">{{ $totalCoordinators }}</h4>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="text-muted">Total Promoters</h6>
                                    <h4 class="text-info">{{ $totalPromoters }}</h4>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="text-muted">Total Commission</h6>
                                    <h4 class="text-success">Rs. {{ number_format($totalCommission, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-user-tie fa-3x mb-3"></i>
                            <h5>No coordinators assigned to this event</h5>
                            <p>Please assign coordinators and promoters to this event to generate the commission sheet.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Commission Settings -->
        @if($eventJob->default_commission_coordinator || $eventJob->salary_rules || $eventJob->special_note)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Commission Settings & Rules</h5>
            </div>
            <div class="card-body">
                @if($eventJob->default_commission_coordinator)
                    <p><strong>Default Coordinator Commission:</strong> Rs. {{ number_format($eventJob->default_commission_coordinator, 2) }} per day</p>
                @endif
                @if($eventJob->salary_rules)
                    <p><strong>Commission Rules:</strong></p>
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
            // Create a new workbook
            const wb = XLSX.utils.book_new();

            // Add event information sheet
            const eventInfo = [
                ['COORDINATOR COMMISSION SHEET'],
                ['Job Number: {{ $eventJob->job_number }}'],
                ['Job Name: {{ $eventJob->job_name }}'],
                ['Client: {{ $eventJob->client_name }}'],
                ['Period: {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format("M d, Y") : "Not Set" }} - {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format("M d, Y") : "Not Set" }}'],
                ['Generated: {{ now()->format("M d, Y \a\t H:i A") }}'],
                [''],
                ['COORDINATOR COMMISSION SUMMARY'],
                ['Coordinator Name', 'Coordinator ID', 'Phone', 'Bank', 'Branch', 'Account', 'Total Commission']
            ];

            // Add coordinator data
            @foreach($coordinatorCommissions as $coordinatorId => $coordinatorData)
                eventInfo.push([
                    '{{ $coordinatorData['coordinator_name'] }}',
                    '{{ $coordinatorData['coordinator_id'] }}',
                    '{{ $coordinatorData['phone_no'] }}',
                    '{{ $coordinatorData['bank_name'] }}',
                    '{{ $coordinatorData['bank_branch'] }}',
                    '{{ $coordinatorData['account_number'] }}',
                    '{{ number_format($coordinatorData['total_commission'], 2) }}'
                ]);
            @endforeach

            const ws = XLSX.utils.aoa_to_sheet(eventInfo);
            XLSX.utils.book_append_sheet(wb, ws, "Commission Summary");

            // Save file
            const fileName = 'Commission_Sheet_{{ $eventJob->job_number }}_{{ now()->format("Y-m-d") }}.xlsx';
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

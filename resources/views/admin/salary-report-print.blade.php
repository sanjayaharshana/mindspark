<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Report - {{ $eventJob->job_name }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            color: #333;
            line-height: 1.4;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
        }
        .header h1 { 
            color: #333; 
            margin-bottom: 10px; 
            font-size: 28px;
            font-weight: bold;
        }
        .header p { 
            color: #666; 
            margin: 5px 0; 
            font-size: 14px;
        }
        .summary { 
            display: flex; 
            justify-content: space-around; 
            margin-bottom: 30px; 
            flex-wrap: wrap;
        }
        .summary-item { 
            text-align: center; 
            padding: 15px; 
            border: 2px solid #007bff; 
            margin: 5px;
            min-width: 150px;
            background-color: #f8f9fa;
        }
        .summary-item h3 { 
            margin: 0; 
            color: #007bff; 
            font-size: 20px;
            font-weight: bold;
        }
        .summary-item p { 
            margin: 5px 0; 
            color: #666; 
            font-size: 12px;
            font-weight: bold;
        }
        .event-info { 
            margin-bottom: 30px; 
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .event-info h3 { 
            color: #333; 
            border-bottom: 2px solid #007bff; 
            padding-bottom: 5px; 
            margin-bottom: 15px;
            font-size: 18px;
        }
        .event-info .row { 
            display: flex; 
            justify-content: space-between; 
            flex-wrap: wrap;
        }
        .event-info .col { 
            width: 48%; 
            min-width: 200px;
        }
        .event-info p {
            margin: 8px 0;
            font-size: 14px;
        }
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px; 
            font-size: 12px;
        }
        .table th, .table td { 
            border: 1px solid #333; 
            padding: 8px; 
            text-align: center; 
        }
        .table th { 
            background-color: #333; 
            color: white; 
            font-weight: bold; 
            font-size: 11px;
        }
        .table tfoot th { 
            background-color: #666; 
            font-size: 12px;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        .text-primary { color: #007bff; }
        .text-success { color: #28a745; }
        .text-warning { color: #ffc107; }
        .text-danger { color: #dc3545; }
        .bg-light { background-color: #f8f9fa; }
        .bg-primary { background-color: #007bff; color: white; }
        .footer { 
            text-align: center; 
            margin-top: 30px; 
            color: #666; 
            font-size: 12px; 
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .section-title {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .settings-box {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
            margin: 10px 0;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
            .summary { page-break-inside: avoid; }
            .table { page-break-inside: auto; }
            .table tr { page-break-inside: avoid; page-break-after: auto; }
        }
        @page {
            margin: 1cm;
            size: A4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SALARY REPORT</h1>
        <p><strong>Job Number:</strong> {{ $eventJob->job_number }}</p>
        <p><strong>Job Name:</strong> {{ $eventJob->job_name }}</p>
        <p><strong>Client:</strong> {{ $eventJob->client_name }}</p>
        <p><strong>Generated:</strong> {{ now()->format('M d, Y \a\t H:i A') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>{{ $totalPromoters }}</h3>
            <p>Total Promoters</p>
        </div>
        <div class="summary-item">
            <h3>{{ $totalDays }}</h3>
            <p>Event Duration (Days)</p>
        </div>
        <div class="summary-item">
            <h3>Rs. {{ number_format($totalSalary, 2) }}</h3>
            <p>Total Salary</p>
        </div>
        <div class="summary-item">
            <h3>Rs. {{ number_format($grandTotal, 2) }}</h3>
            <p>Grand Total</p>
        </div>
    </div>

    <div class="event-info">
        <h3>Event Information</h3>
        <div class="row">
            <div class="col">
                <p><strong>Officer:</strong> {{ $eventJob->officer_name }}</p>
                <p><strong>Reporter Officer:</strong> {{ $eventJob->reporter_officer_name }}</p>
            </div>
            <div class="col">
                <p><strong>Start Date:</strong> {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('M d, Y') : 'Not Set' }}</p>
                <p><strong>End Date:</strong> {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('M d, Y') : 'Not Set' }}</p>
            </div>
        </div>
    </div>

    <h3 class="section-title">Promoter Details & Salary Breakdown</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Promoter ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Coordinator</th>
                <th>Daily Salary</th>
                <th>Commission</th>
                @if($totalDays > 0)
                    <th>Present Days</th>
                    <th>Absent Days</th>
                    <th>Total Days</th>
                @endif
                <th>Total Salary</th>
                <th>Total Commission</th>
                <th>Subtotal</th>
            </tr>
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
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ $assignment->promoter->promoter_id }}</td>
                    <td class="fw-bold">{{ $assignment->promoter->promoter_name }}</td>
                    <td>{{ $assignment->promoter->phone_no ?? 'N/A' }}</td>
                    <td>{{ $assignment->coordinator->coordinator_name ?? 'N/A' }}</td>
                    <td class="fw-bold">Rs. {{ number_format($assignment->promoter_salary_per_day, 2) }}</td>
                    <td class="fw-bold">Rs. {{ number_format($assignment->supervisor_commission, 2) }}</td>
                    @if($totalDays > 0)
                        <td class="fw-bold">{{ $presentDays }}</td>
                        <td class="fw-bold">{{ $absentDays }}</td>
                        <td class="fw-bold">{{ $totalDays }}</td>
                    @endif
                    <td class="fw-bold">Rs. {{ number_format($promoterTotalSalary, 2) }}</td>
                    <td class="fw-bold">Rs. {{ number_format($coordinatorTotalCommission, 2) }}</td>
                    <td class="fw-bold">Rs. {{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="{{ $totalDays > 0 ? '7' : '6' }}" class="text-end fw-bold">TOTALS:</th>
                @if($totalDays > 0)
                    <th>{{ $assignedPromoters->sum(function($assignment) use ($attendanceData) { return isset($attendanceData[$assignment->promoter_id]) ? $attendanceData[$assignment->promoter_id]->where('status', 'attend')->count() : 0; }) }}</th>
                    <th>{{ $assignedPromoters->sum(function($assignment) use ($attendanceData) { return isset($attendanceData[$assignment->promoter_id]) ? $attendanceData[$assignment->promoter_id]->where('status', 'absent')->count() : 0; }) }}</th>
                    <th>{{ $totalDays * $assignedPromoters->count() }}</th>
                @endif
                <th class="fw-bold">Rs. {{ number_format($totalSalary, 2) }}</th>
                <th class="fw-bold">Rs. {{ number_format($totalCommission, 2) }}</th>
                <th class="fw-bold">Rs. {{ number_format($grandTotal, 2) }}</th>
            </tr>
            <tr>
                <th colspan="{{ $totalDays > 0 ? '13' : '12' }}" class="text-center fw-bold" style="background-color: #007bff; color: white;">
                    <i class="fas fa-info-circle"></i> 
                    Salary calculations are based on actual present days only
                </th>
            </tr>
        </tfoot>
    </table>

    @if($eventJob->default_salary_promoter || $eventJob->default_commission_coordinator || $eventJob->salary_rules || $eventJob->special_note)
    <div class="event-info">
        <h3>Salary Settings & Rules</h3>
        @if($eventJob->default_salary_promoter)
            <div class="settings-box">
                <p><strong>Default Promoter Salary:</strong> Rs. {{ number_format($eventJob->default_salary_promoter, 2) }} per day</p>
            </div>
        @endif
        @if($eventJob->default_commission_coordinator)
            <div class="settings-box">
                <p><strong>Default Coordinator Commission:</strong> Rs. {{ number_format($eventJob->default_commission_coordinator, 2) }} per day</p>
            </div>
        @endif
        @if($eventJob->salary_rules)
            <div class="settings-box">
                <p><strong>Salary Rules:</strong></p>
                <div style="background-color: white; padding: 10px; border: 1px solid #ccc;">
                    {!! nl2br(e($eventJob->salary_rules)) !!}
                </div>
            </div>
        @endif
        @if($eventJob->special_note)
            <div class="settings-box">
                <p><strong>Special Notes:</strong></p>
                <div style="background-color: white; padding: 10px; border: 1px solid #ccc;">
                    {!! nl2br(e($eventJob->special_note)) !!}
                </div>
            </div>
        @endif
    </div>
    @endif

    <div class="footer">
        <p>Generated on {{ now()->format('M d, Y \a\t H:i A') }} | MindSpark Event Management System</p>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>

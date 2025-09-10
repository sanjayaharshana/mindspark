<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission Sheet - {{ $eventJob->job_name }}</title>
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
            border-bottom: 2px solid #333;
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
            border: 1px solid #333; 
            margin: 5px;
            min-width: 150px;
            background-color: #f8f9fa;
        }
        .summary-item h3 { 
            margin: 0; 
            color: #333; 
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
            border: 1px solid #333;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .event-info h3 { 
            color: #333; 
            border-bottom: 1px solid #333; 
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
        .coordinator-section {
            margin-bottom: 40px;
            page-break-inside: avoid;
        }
        .coordinator-header {
            background-color: #f8f9fa;
            color: #333;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #333;
        }
        .coordinator-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .coordinator-details {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #333;
        }
        .coordinator-details .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .coordinator-details .col {
            width: 48%;
            min-width: 200px;
        }
        .coordinator-details p {
            margin: 5px 0;
            font-size: 13px;
        }
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
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
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .settings-box {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #333;
            margin: 10px 0;
        }
        .grand-total {
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
            margin-top: 30px;
            border: 2px solid #333;
        }
        .grand-total h3 {
            margin: 0 0 15px 0;
            font-size: 20px;
            font-weight: bold;
        }
        .grand-total .row {
            display: flex;
            justify-content: space-around;
        }
        .grand-total .col {
            text-align: center;
        }
        .grand-total h4 {
            margin: 5px 0;
            font-size: 18px;
            font-weight: bold;
        }
        .grand-total h6 {
            margin: 5px 0;
            color: #666;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
            .coordinator-section { page-break-inside: avoid; }
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
        <h1>COORDINATOR COMMISSION SHEET</h1>
        <p><strong>Job Number:</strong> {{ $eventJob->job_number }}</p>
        <p><strong>Job Name:</strong> {{ $eventJob->job_name }}</p>
        <p><strong>Client:</strong> {{ $eventJob->client_name }}</p>
        <p><strong>Generated:</strong> {{ now()->format('M d, Y \a\t H:i A') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>{{ $totalCoordinators }}</h3>
            <p>Total Coordinators</p>
        </div>
        <div class="summary-item">
            <h3>{{ $totalPromoters }}</h3>
            <p>Total Promoters</p>
        </div>
        <div class="summary-item">
            <h3>{{ $totalDays }}</h3>
            <p>Event Duration (Days)</p>
        </div>
        <div class="summary-item">
            <h3>Rs. {{ number_format($totalCommission, 2) }}</h3>
            <p>Total Commission</p>
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

    <h3 class="section-title">Coordinator Commission Breakdown</h3>

    @if(count($coordinatorCommissions) > 0)
        @foreach($coordinatorCommissions as $coordinatorId => $coordinatorData)
            <div class="coordinator-section">
                <!-- Coordinator Header -->
                <div class="coordinator-header">
                    <h3>{{ $coordinatorData['coordinator_name'] }} (ID: {{ $coordinatorData['coordinator_id'] }})</h3>
                </div>

                <!-- Coordinator Details -->
                <div class="coordinator-details">
                    <div class="row">
                        <div class="col">
                            <p><strong>Phone:</strong> {{ $coordinatorData['phone_no'] }}</p>
                            <p><strong>Bank:</strong> {{ $coordinatorData['bank_name'] }}</p>
                        </div>
                        <div class="col">
                            <p><strong>Branch:</strong> {{ $coordinatorData['bank_branch'] }}</p>
                            <p><strong>Account:</strong> {{ $coordinatorData['account_number'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Promoters Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Promoter ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Daily Commission</th>
                            <th>Present Days</th>
                            <th>Absent Days</th>
                            <th>Total Days</th>
                            <th>Commission Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coordinatorData['promoters'] as $index => $promoter)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $promoter['promoter_id'] }}</td>
                                <td class="fw-bold">{{ $promoter['promoter_name'] }}</td>
                                <td>{{ $promoter['phone_no'] }}</td>
                                <td class="fw-bold">Rs. {{ number_format($promoter['daily_commission'], 2) }}</td>
                                <td class="fw-bold">{{ $promoter['present_days'] }}</td>
                                <td class="fw-bold">{{ $promoter['absent_days'] }}</td>
                                <td class="fw-bold">{{ $promoter['total_days'] }}</td>
                                <td class="fw-bold">Rs. {{ number_format($promoter['commission_amount'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end fw-bold">COORDINATOR TOTALS:</th>
                            <th class="fw-bold">-</th>
                            <th class="fw-bold">{{ $coordinatorData['total_present_days'] }}</th>
                            <th class="fw-bold">{{ $coordinatorData['total_absent_days'] ?? 0 }}</th>
                            <th class="fw-bold">{{ count($coordinatorData['promoters']) * $totalDays }}</th>
                            <th class="fw-bold">Rs. {{ number_format($coordinatorData['total_commission'], 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endforeach

        <!-- Grand Total -->
        <div class="grand-total">
            <h3>Grand Total Commission Summary</h3>
            <div class="row">
                <div class="col">
                    <h6>Total Coordinators</h6>
                    <h4>{{ $totalCoordinators }}</h4>
                </div>
                <div class="col">
                    <h6>Total Promoters</h6>
                    <h4>{{ $totalPromoters }}</h4>
                </div>
                <div class="col">
                    <h6>Total Commission</h6>
                    <h4>Rs. {{ number_format($totalCommission, 2) }}</h4>
                </div>
            </div>
        </div>
    @else
        <div class="event-info">
            <h3>No Coordinators Assigned</h3>
            <p>Please assign coordinators and promoters to this event to generate the commission sheet.</p>
        </div>
    @endif

    @if($eventJob->default_commission_coordinator || $eventJob->salary_rules || $eventJob->special_note)
    <div class="event-info">
        <h3>Commission Settings & Rules</h3>
        @if($eventJob->default_commission_coordinator)
            <div class="settings-box">
                <p><strong>Default Coordinator Commission:</strong> Rs. {{ number_format($eventJob->default_commission_coordinator, 2) }} per day</p>
            </div>
        @endif
        @if($eventJob->salary_rules)
            <div class="settings-box">
                <p><strong>Commission Rules:</strong></p>
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

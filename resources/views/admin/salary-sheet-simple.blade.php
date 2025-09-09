<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Salary Sheet - {{ $eventJob->job_name }}</h3>
                </div>
                <div class="card-body">
                    <h4>{{ $eventJob->job_name }}</h4>
                    <p><strong>Job Number:</strong> {{ $eventJob->job_number }}</p>
                    <p><strong>Client:</strong> {{ $eventJob->client_name }}</p>
                    <p><strong>Start Date:</strong> {{ $eventJob->activation_start_date ? $eventJob->activation_start_date->format('Y-m-d') : 'Not set' }}</p>
                    <p><strong>End Date:</strong> {{ $eventJob->activation_end_date ? $eventJob->activation_end_date->format('Y-m-d') : 'Ongoing' }}</p>
                    
                    <h5>Assigned Promoters ({{ $assignedPromoters->count() }})</h5>
                    @if($assignedPromoters->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Promoter ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Daily Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignedPromoters as $assignment)
                                        <tr>
                                            <td>{{ $assignment->promoter->promoter_id }}</td>
                                            <td>{{ $assignment->promoter->promoter_name }}</td>
                                            <td>{{ $assignment->promoter->phone_no }}</td>
                                            <td>Rs. {{ number_format($assignment->promoter_salary_per_day, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No promoters assigned to this event job.</p>
                    @endif
                    
                    <div class="mt-3">
                        <a href="{{ admin_url('event-jobs') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back to Event Jobs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

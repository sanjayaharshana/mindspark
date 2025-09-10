<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="salary-icon me-3">
                                    <i class="icon-user fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h2 class="mb-1 text-dark fw-bold">{{ $eventJob->job_name }}</h2>
                                    <p class="mb-0 text-muted">Promoter Assignment Management</p>
                                    <small class="text-muted">Job #{{ $eventJob->job_number }} | {{ $eventJob->client_name }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ admin_url('event-jobs/' . $eventJob->id . '/salary-sheet') }}" class="btn btn-outline-secondary">
                                    <i class="icon-arrow-left me-1"></i> Back to Salary Sheet
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignment Form -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0"><i class="icon-plus me-2 text-primary"></i>Assign New Promoter</h5>
                        </div>
                        <div class="card-body">
                            <form id="assign-promoter-form">
                                <input type="hidden" name="event_id" value="{{ $eventJob->id }}">
                                
                                <div class="mb-3">
                                    <label for="promoter_id" class="form-label">Select Promoter</label>
                                    <select class="form-select" id="promoter_id" name="promoter_id" required>
                                        <option value="">Choose a promoter...</option>
                                        @foreach($availablePromoters as $promoter)
                                            <option value="{{ $promoter->id }}">{{ $promoter->promoter_name }} ({{ $promoter->promoter_id }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="supervisor_id" class="form-label">Select Coordinator</label>
                                    <select class="form-select" id="supervisor_id" name="supervisor_id" required>
                                        <option value="">Choose a coordinator...</option>
                                        @foreach($supervisors as $supervisor)
                                            <option value="{{ $supervisor->id }}">{{ $supervisor->coordinator_name }} ({{ $supervisor->coordinator_id }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="promoter_salary_per_day" class="form-label">Daily Salary ($)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="promoter_salary_per_day" name="promoter_salary_per_day" step="0.01" min="0" value="{{ $eventJob->default_salary_promoter ?? '' }}" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="resetToDefault('promoter_salary_per_day', {{ $eventJob->default_salary_promoter ?? 0 }})">
                                            <i class="icon-refresh"></i> Reset
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">Default: ${{ number_format($eventJob->default_salary_promoter ?? 0, 2) }}</small>
                                </div>

                                <div class="mb-3">
                                    <label for="supervisor_commission" class="form-label">Coordinator Commission ($)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="supervisor_commission" name="supervisor_commission" step="0.01" min="0" value="{{ $eventJob->default_commission_coordinator ?? '' }}" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="resetToDefault('supervisor_commission', {{ $eventJob->default_commission_coordinator ?? 0 }})">
                                            <i class="icon-refresh"></i> Reset
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">Default: ${{ number_format($eventJob->default_commission_coordinator ?? 0, 2) }}</small>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-2">
                                    <i class="icon-plus me-1"></i> Assign Promoter
                                </button>
                                
                                <button type="button" class="btn btn-outline-secondary w-100" onclick="resetAllToDefaults()">
                                    <i class="icon-refresh me-1"></i> Reset to Defaults
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Assigned Promoters -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0"><i class="icon-user me-2 text-success"></i>Assigned Promoters ({{ $assignedPromoters->count() }})</h5>
                        </div>
                        <div class="card-body">
                            @if($assignedPromoters->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Promoter</th>
                                                <th>Coordinator</th>
                                                <th>Salary</th>
                                                <th>Commission</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($assignedPromoters as $assignment)
                                                <tr>
                                                    <td>
                                                        <small class="fw-medium">{{ $assignment->promoter->promoter_name }}</small><br>
                                                        <small class="text-muted">{{ $assignment->promoter->promoter_id }}</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-info">{{ $assignment->coordinator->coordinator_name }}</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-success fw-bold">${{ number_format($assignment->promoter_salary_per_day, 2) }}</small>
                                                    </td>
                                                    <td>
                                                        <small class="text-warning fw-bold">${{ number_format($assignment->supervisor_commission, 2) }}</small>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-danger btn-sm" onclick="removeAssignment({{ $assignment->id }})">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="icon-user fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No promoters assigned yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('assign-promoter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ admin_url("event-jobs/assign-promoter") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Promoter assigned successfully!');
            location.reload();
        } else {
            alert(data.error || 'An error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while assigning the promoter');
    });
});

function removeAssignment(assignmentId) {
    if (confirm('Are you sure you want to remove this promoter assignment?')) {
        fetch('{{ admin_url("event-jobs/remove-promoter-assignment") }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                assignment_id: assignmentId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Promoter assignment removed successfully!');
                location.reload();
            } else {
                alert(data.error || 'An error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the assignment');
        });
    }
}

// Function to reset field to default value
function resetToDefault(fieldId, defaultValue) {
    const field = document.getElementById(fieldId);
    if (field) {
        field.value = defaultValue;
        field.focus();
        
        // Add visual feedback
        field.style.backgroundColor = '#d4edda';
        setTimeout(() => {
            field.style.backgroundColor = '';
        }, 1000);
    }
}

// Function to reset all fields to default values
function resetAllToDefaults() {
    if (confirm('Reset all salary fields to default values?')) {
        resetToDefault('promoter_salary_per_day', {{ $eventJob->default_salary_promoter ?? 0 }});
        resetToDefault('supervisor_commission', {{ $eventJob->default_commission_coordinator ?? 0 }});
    }
}
</script>

<style>
.salary-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    border-radius: 15px;
}

.form-control, .form-select {
    border-radius: 8px;
}

.btn {
    border-radius: 8px;
}

.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.875rem;
}

.table td {
    font-size: 0.875rem;
    vertical-align: middle;
}

.input-group .btn {
    border-radius: 0 8px 8px 0;
}

.input-group .form-control {
    border-radius: 8px 0 0 8px;
}

.form-text {
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}
</style>

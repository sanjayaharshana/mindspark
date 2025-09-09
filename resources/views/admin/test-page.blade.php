<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Test Page</h3>
                </div>
                <div class="card-body">
                    <h4>{{ $eventJob->job_name }}</h4>
                    <p>This is a simple test page to check if the duplicate sidebar issue occurs.</p>
                    <p>Event Job ID: {{ $eventJob->id }}</p>
                    <p>Client: {{ $eventJob->client_name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('admin::index')

@section('content')
<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="welcome-content">
            <h1 class="welcome-title">Welcome to MindSpark</h1>
            <p class="welcome-subtitle">Campaign Management & Promotional Services</p>
            <div class="welcome-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['campaigns']['total'] }}</span>
                    <span class="stat-label">Total Campaigns</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['campaigns']['active'] }}</span>
                    <span class="stat-label">Active Campaigns</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['customers']['total'] + $stats['organizers']['total'] + $stats['promoters']['total'] + $stats['supervisors']['total'] }}</span>
                    <span class="stat-label">Total Staff</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card campaigns">
            <div class="stat-icon">
                <i class="icon-bullhorn"></i>
            </div>
            <div class="stat-content">
                <h3>Campaigns</h3>
                <div class="stat-number">{{ $stats['campaigns']['total'] }}</div>
                <div class="stat-details">
                    <span class="active">{{ $stats['campaigns']['active'] }} Active</span>
                    <span class="pending">{{ $stats['campaigns']['pending'] }} Pending</span>
                </div>
            </div>
        </div>

        <div class="stat-card customers">
            <div class="stat-icon">
                <i class="icon-users"></i>
            </div>
            <div class="stat-content">
                <h3>Customers</h3>
                <div class="stat-number">{{ $stats['customers']['total'] }}</div>
                <div class="stat-details">
                    <span class="active">{{ $stats['customers']['active'] }} Active</span>
                    <span class="inactive">{{ $stats['customers']['inactive'] }} Inactive</span>
                </div>
            </div>
        </div>

        <div class="stat-card organizers">
            <div class="stat-icon">
                <i class="icon-user-tie"></i>
            </div>
            <div class="stat-content">
                <h3>Organizers</h3>
                <div class="stat-number">{{ $stats['organizers']['total'] }}</div>
                <div class="stat-details">
                    <span class="active">{{ $stats['organizers']['active'] }} Active</span>
                    <span class="inactive">{{ $stats['organizers']['inactive'] }} Inactive</span>
                </div>
            </div>
        </div>

        <div class="stat-card promoters">
            <div class="stat-icon">
                <i class="icon-user"></i>
            </div>
            <div class="stat-content">
                <h3>Promoters</h3>
                <div class="stat-number">{{ $stats['promoters']['total'] }}</div>
                <div class="stat-details">
                    <span class="active">{{ $stats['promoters']['active'] }} Active</span>
                    <span class="inactive">{{ $stats['promoters']['inactive'] + $stats['promoters']['suspended'] }} Other</span>
                </div>
            </div>
        </div>

        <div class="stat-card supervisors">
            <div class="stat-icon">
                <i class="icon-user-tie"></i>
            </div>
            <div class="stat-content">
                <h3>Supervisors</h3>
                <div class="stat-number">{{ $stats['supervisors']['total'] }}</div>
                <div class="stat-details">
                    <span class="active">{{ $stats['supervisors']['active'] }} Active</span>
                    <span class="inactive">{{ $stats['supervisors']['inactive'] + $stats['supervisors']['retired'] }} Other</span>
                </div>
            </div>
        </div>

        <div class="stat-card monthly">
            <div class="stat-icon">
                <i class="icon-calendar"></i>
            </div>
            <div class="stat-content">
                <h3>This Month</h3>
                <div class="stat-number">{{ $stats['campaigns']['monthly'] }}</div>
                <div class="stat-details">
                    <span>New Campaigns</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaign Status Overview -->
    <div class="dashboard-section">
        <div class="section-header">
            <h2>Campaign Status Overview</h2>
        </div>
        <div class="status-grid">
            <div class="status-card active">
                <div class="status-icon">
                    <i class="icon-check-circle"></i>
                </div>
                <div class="status-content">
                    <h4>Active Campaigns</h4>
                    <div class="status-number">{{ $stats['campaigns']['active'] }}</div>
                    <div class="status-percentage">{{ round(($stats['campaigns']['active'] / max($stats['campaigns']['total'], 1)) * 100, 1) }}%</div>
                </div>
            </div>

            <div class="status-card pending">
                <div class="status-icon">
                    <i class="icon-clock"></i>
                </div>
                <div class="status-content">
                    <h4>Pending Campaigns</h4>
                    <div class="status-number">{{ $stats['campaigns']['pending'] }}</div>
                    <div class="status-percentage">{{ round(($stats['campaigns']['pending'] / max($stats['campaigns']['total'], 1)) * 100, 1) }}%</div>
                </div>
            </div>

            <div class="status-card completed">
                <div class="status-icon">
                    <i class="icon-trophy"></i>
                </div>
                <div class="status-content">
                    <h4>Completed Campaigns</h4>
                    <div class="status-number">{{ $stats['campaigns']['completed'] }}</div>
                    <div class="status-percentage">{{ round(($stats['campaigns']['completed'] / max($stats['campaigns']['total'], 1)) * 100, 1) }}%</div>
                </div>
            </div>

            <div class="status-card inactive">
                <div class="status-icon">
                    <i class="icon-pause"></i>
                </div>
                <div class="status-content">
                    <h4>Inactive Campaigns</h4>
                    <div class="status-number">{{ $stats['campaigns']['inactive'] }}</div>
                    <div class="status-percentage">{{ round(($stats['campaigns']['inactive'] / max($stats['campaigns']['total'], 1)) * 100, 1) }}%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="dashboard-section">
        <div class="section-header">
            <h2>Recent Campaigns</h2>
            <a href="/admin/campaigns" class="view-all">View All</a>
        </div>
        <div class="recent-campaigns">
            @foreach($stats['recent_campaigns'] as $campaign)
            <div class="campaign-item">
                <div class="campaign-info">
                    <h4>{{ $campaign->name }}</h4>
                    <p class="campaign-id">{{ $campaign->campaign_id }}</p>
                    <p class="campaign-date">{{ $campaign->created_at->format('M d, Y') }}</p>
                </div>
                <div class="campaign-status">
                    <span class="status-badge {{ $campaign->status }}">
                        {{ ucfirst($campaign->status) }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="dashboard-section">
        <div class="section-header">
            <h2>Quick Actions</h2>
        </div>
        <div class="quick-actions">
            <a href="/admin/campaigns/create" class="action-card">
                <div class="action-icon">
                    <i class="icon-plus"></i>
                </div>
                <h4>Create Campaign</h4>
                <p>Start a new marketing campaign</p>
            </a>

            <a href="/admin/customers/create" class="action-card">
                <div class="action-icon">
                    <i class="icon-user-plus"></i>
                </div>
                <h4>Add Customer</h4>
                <p>Register a new customer</p>
            </a>

            <a href="/admin/promoters/create" class="action-card">
                <div class="action-icon">
                    <i class="icon-user-plus"></i>
                </div>
                <h4>Add Promoter</h4>
                <p>Register a new promoter</p>
            </a>

            <a href="/admin/supervisors/create" class="action-card">
                <div class="action-icon">
                    <i class="icon-user-plus"></i>
                </div>
                <h4>Add Supervisor</h4>
                <p>Register a new supervisor</p>
            </a>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 2rem;
    background: #f8f9fa;
    min-height: 100vh;
}

.welcome-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    text-align: center;
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.welcome-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.welcome-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-card.campaigns .stat-icon { background: #007bff; }
.stat-card.customers .stat-icon { background: #28a745; }
.stat-card.organizers .stat-icon { background: #17a2b8; }
.stat-card.promoters .stat-icon { background: #ffc107; }
.stat-card.supervisors .stat-icon { background: #dc3545; }
.stat-card.monthly .stat-icon { background: #6f42c1; }

.stat-content h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    color: #333;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.25rem;
}

.stat-details {
    display: flex;
    gap: 1rem;
    font-size: 0.85rem;
}

.stat-details .active { color: #28a745; }
.stat-details .pending { color: #ffc107; }
.stat-details .inactive { color: #6c757d; }

.dashboard-section {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-header h2 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
}

.view-all {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.status-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.status-card {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    border-left: 4px solid;
}

.status-card.active { border-left-color: #28a745; }
.status-card.pending { border-left-color: #ffc107; }
.status-card.completed { border-left-color: #17a2b8; }
.status-card.inactive { border-left-color: #6c757d; }

.status-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.status-card.active .status-icon { color: #28a745; }
.status-card.pending .status-icon { color: #ffc107; }
.status-card.completed .status-icon { color: #17a2b8; }
.status-card.inactive .status-icon { color: #6c757d; }

.status-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
    color: #333;
}

.status-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.25rem;
}

.status-percentage {
    font-size: 0.9rem;
    color: #6c757d;
}

.recent-campaigns {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.campaign-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.campaign-info h4 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    color: #333;
}

.campaign-id {
    margin: 0 0 0.25rem 0;
    font-size: 0.85rem;
    color: #6c757d;
}

.campaign-date {
    margin: 0;
    font-size: 0.85rem;
    color: #6c757d;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
}

.status-badge.active { background: #d4edda; color: #155724; }
.status-badge.pending { background: #fff3cd; color: #856404; }
.status-badge.completed { background: #d1ecf1; color: #0c5460; }
.status-badge.inactive { background: #f8d7da; color: #721c24; }

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.action-card {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    text-decoration: none;
    color: #333;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 2px solid transparent;
}

.action-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-color: #007bff;
    color: #333;
}

.action-icon {
    width: 50px;
    height: 50px;
    background: #007bff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
    color: white;
    font-size: 1.2rem;
}

.action-card h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
}

.action-card p {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }
    
    .welcome-section {
        padding: 2rem 1rem;
    }
    
    .welcome-title {
        font-size: 2rem;
    }
    
    .welcome-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .status-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

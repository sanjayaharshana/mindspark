<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoterEventJob extends Model
{
    use HasFactory;

    protected $table = 'promoters_for_event_job';

    protected $fillable = [
        'promoter_id',
        'event_id',
        'supervisor_id',
        'supervisor_commission',
        'promoter_salary_per_day',
    ];

    protected $casts = [
        'supervisor_commission' => 'decimal:2',
        'promoter_salary_per_day' => 'decimal:2',
    ];

    /**
     * Get the promoter assigned to this event job
     */
    public function promoter()
    {
        return $this->belongsTo(Promoter::class, 'promoter_id');
    }

    /**
     * Get the event job
     */
    public function eventJob()
    {
        return $this->belongsTo(EventJob::class, 'event_id');
    }

    /**
     * Get the coordinator for this promoter assignment
     */
    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class, 'supervisor_id');
    }

    /**
     * Alias for coordinator (for backward compatibility)
     */
    public function supervisor()
    {
        return $this->coordinator();
    }

    /**
     * Scope to get assignments for a specific event
     */
    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    /**
     * Scope to get assignments for a specific coordinator
     */
    public function scopeForCoordinator($query, $coordinatorId)
    {
        return $query->where('supervisor_id', $coordinatorId);
    }

    /**
     * Scope to get assignments for a specific supervisor (alias)
     */
    public function scopeForSupervisor($query, $supervisorId)
    {
        return $query->scopeForCoordinator($query, $supervisorId);
    }
}
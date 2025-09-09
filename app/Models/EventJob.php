<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventJob extends Model
{
    protected $table = 'event_jobs';

    protected $fillable = [
        'job_number',
        'job_name',
        'client_name',
        'activation_start_date',
        'activation_end_date',
        'officer_name',
        'reporter_officer_name',
        'default_commission_coordinator',
        'default_salary_promoter',
        'salary_rules',
        'special_note',
    ];

    protected $casts = [
        'activation_start_date' => 'date',
        'activation_end_date' => 'date',
    ];

    /**
     * Get the promoters for the event job.
     */
    public function promoters(): HasMany
    {
        return $this->hasMany(Promoter::class);
    }

    /**
     * Get the assigned promoters for this event job with their details
     */
    public function assignedPromoters()
    {
        return $this->hasMany(PromoterEventJob::class, 'event_id');
    }

    /**
     * Get the coordinators for the event job.
     */
    public function coordinators(): HasMany
    {
        return $this->hasMany(Coordinator::class);
    }

    /**
     * Get the client for the event job.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_name', 'company_name');
    }
}

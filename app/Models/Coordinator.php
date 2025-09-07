<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coordinator extends Model
{
    protected $fillable = [
        'event_job_id',
        'coordinator_id',
        'coordinator_name',
        'nic_no',
        'phone_no',
        'bank_name',
        'bank_branch_name',
        'account_number',
    ];

    /**
     * Get the event job that owns the coordinator.
     */
    public function eventJob(): BelongsTo
    {
        return $this->belongsTo(EventJob::class);
    }
}

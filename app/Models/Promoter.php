<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promoter extends Model
{
    protected $fillable = [
        'event_job_id',
        'promoter_id',
        'promoter_name',
        'id_no',
        'phone_no',
        'bank_name',
        'bank_branch_name',
        'account_number',
    ];

    /**
     * Get the event job that owns the promoter.
     */
    public function eventJob(): BelongsTo
    {
        return $this->belongsTo(EventJob::class);
    }

    /**
     * Get the event job assignments for this promoter
     */
    public function eventJobAssignments()
    {
        return $this->hasMany(PromoterEventJob::class, 'promoter_id');
    }

    /**
     * Get the promoters supervised by this promoter (as coordinator)
     */
    public function coordinatedPromoters()
    {
        return $this->hasMany(PromoterEventJob::class, 'supervisor_id');
    }

    /**
     * Alias for coordinatedPromoters (for backward compatibility)
     */
    public function supervisedPromoters()
    {
        return $this->coordinatedPromoters();
    }

    /**
     * Check if this promoter is a coordinator
     */
    public function isCoordinator()
    {
        return $this->coordinatedPromoters()->exists();
    }

    /**
     * Alias for isCoordinator (for backward compatibility)
     */
    public function isSupervisor()
    {
        return $this->isCoordinator();
    }
}

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
}

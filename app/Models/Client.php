<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'client_code',
        'company_name',
        'contact_person_name',
        'contact_person_designation',
        'email',
        'phone_number',
        'mobile_number',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'website',
        'industry',
        'client_type',
        'status',
        'notes',
    ];

    protected $casts = [
        'client_type' => 'string',
        'status' => 'string',
    ];

    /**
     * Get the event jobs for the client.
     */
    public function eventJobs(): HasMany
    {
        return $this->hasMany(EventJob::class, 'client_name', 'company_name');
    }

    /**
     * Scope for active clients
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive clients
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope for suspended clients
     */
    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }
}

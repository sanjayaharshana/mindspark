<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizerFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'position',
        'status',
    ];

    /**
     * Get the campaigns organized by this organizer.
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'organizer_id');
    }

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status ?? 'active') {
            'active' => 'success',
            'inactive' => 'danger',
            'pending' => 'warning',
            default => 'secondary',
        };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    /** @use HasFactory<\Database\Factories\SupervisorFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supervisor_id',
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'emergency_contact',
        'emergency_phone',
        'department',
        'position',
        'employee_id',
        'bank_name',
        'bank_account',
        'tax_id',
        'base_salary',
        'bonus_percentage',
        'status',
        'join_date',
        'promotion_date',
        'team_size',
        'responsibilities',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'join_date' => 'date',
        'promotion_date' => 'date',
        'base_salary' => 'decimal:2',
        'bonus_percentage' => 'decimal:2',
        'team_size' => 'integer',
    ];

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'active' => 'success',
            'inactive' => 'danger',
            'suspended' => 'warning',
            'retired' => 'secondary',
            default => 'secondary',
        };
    }

    /**
     * Scope a query to only include active supervisors.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive supervisors.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Get the age of the supervisor.
     */
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            return $this->date_of_birth->age;
        }
        return null;
    }

    /**
     * Get the years of service.
     */
    public function getYearsOfServiceAttribute()
    {
        if ($this->join_date) {
            return $this->join_date->diffInYears(now());
        }
        return null;
    }

    /**
     * Get the years since promotion.
     */
    public function getYearsSincePromotionAttribute()
    {
        if ($this->promotion_date) {
            return $this->promotion_date->diffInYears(now());
        }
        return null;
    }

    /**
     * Calculate total compensation including bonus.
     */
    public function getTotalCompensationAttribute()
    {
        $bonus = ($this->base_salary * $this->bonus_percentage) / 100;
        return $this->base_salary + $bonus;
    }

    /**
     * Get the bonus amount.
     */
    public function getBonusAmountAttribute()
    {
        return ($this->base_salary * $this->bonus_percentage) / 100;
    }
}

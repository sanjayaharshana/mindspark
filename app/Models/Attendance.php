<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'promoter_id',
        'promoter_attend_date',
        'event_id',
        'status',
    ];

    protected $casts = [
        'promoter_attend_date' => 'date',
    ];

    // Relationships
    public function promoter()
    {
        return $this->belongsTo(Promoter::class, 'promoter_id');
    }

    public function eventJob()
    {
        return $this->belongsTo(EventJob::class, 'event_id');
    }

    // Scopes
    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    public function scopeForPromoter($query, $promoterId)
    {
        return $query->where('promoter_id', $promoterId);
    }

    public function scopeForDate($query, $date)
    {
        return $query->where('promoter_attend_date', $date);
    }

    public function scopePresent($query)
    {
        return $query->where('status', 'attend');
    }

    public function scopeAbsent($query)
    {
        return $query->where('status', 'absent');
    }

    // Helper methods
    public static function getAttendanceForEvent($eventId, $startDate, $endDate)
    {
        return self::forEvent($eventId)
            ->whereBetween('promoter_attend_date', [$startDate, $endDate])
            ->with('promoter')
            ->get()
            ->groupBy('promoter_id');
    }

    public static function markAttendance($promoterId, $eventId, $date, $status)
    {
        return self::updateOrCreate(
            [
                'promoter_id' => $promoterId,
                'event_id' => $eventId,
                'promoter_attend_date' => $date,
            ],
            [
                'status' => $status,
            ]
        );
    }

    public static function getAttendanceStats($eventId, $promoterId, $startDate, $endDate)
    {
        $totalDays = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
        $presentDays = self::forEvent($eventId)
            ->forPromoter($promoterId)
            ->whereBetween('promoter_attend_date', [$startDate, $endDate])
            ->present()
            ->count();
        $absentDays = $totalDays - $presentDays;

        return [
            'total_days' => $totalDays,
            'present_days' => $presentDays,
            'absent_days' => $absentDays,
        ];
    }
}
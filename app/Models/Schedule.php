<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day',
        'start_time',
        'end_time',
        'slot_duration',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /** Scope for multi-role visibility **/
    public function scopeVisibleTo($query, $user)
    {
        if ($user->hasRole('admin')) {
            return $query;
        } elseif ($user->hasRole('doctor')) {
            return $query->where('doctor_id', $user->doctor?->id);
        } else {
            return $query->whereRaw('1 = 0'); // hide from patients
        }
    }

    /**
     * Get available time slots for a doctor on a specific date
     *
     * @param int $doctorId
     * @param string $date
     * @return array
     */
    public static function availableSlots($doctorId, $date)
    {
        try {
            $dayOfWeek = strtolower(now()->parse($date)->format('l'));
            
            // Get the doctor's schedule for the given day
            $schedule = self::where('doctor_id', $doctorId)
                ->where('day', $dayOfWeek)
                ->first();

            if (!$schedule) {
                return [];
            }

            // Parse start and end times
            $startTime = now()->parse($schedule->start_time);
            $endTime = now()->parse($schedule->end_time);
            $slotDuration = $schedule->slot_duration ?? 30; // default to 30 minutes

            // Generate time slots
            $slots = [];
            $currentTime = $startTime->copy();

            while ($currentTime->addMinutes($slotDuration)->lte($endTime)) {
                $timeString = $currentTime->format('H:i');
                $slots[$timeString] = $timeString;
            }

            // Get all booked appointments for the selected date and doctor
            $bookedAppointments = \App\Models\Appointment::where('doctor_id', $doctorId)
                ->whereDate('date', $date)
                ->pluck('time')
                ->map(function($time) {
                    try {
                        return now()->parse($time)->format('H:i');
                    } catch (\Exception $e) {
                        return null;
                    }
                })
                ->filter()
                ->toArray();

            // Remove booked slots and ensure valid format
            $availableSlots = [];
            foreach ($slots as $key => $value) {
                if (!in_array($key, $bookedAppointments)) {
                    $availableSlots[$key] = $value;
                }
            }

            return $availableSlots;
        } catch (\Exception $e) {
            \Log::error('Error in availableSlots: ' . $e->getMessage());
            return [];
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_id',
        'date',
        'time',
        'status',
        'notes',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /** Scope for multi-role visibility **/
    public function scopeVisibleTo(Builder $query, $user)
    {
        if ($user->hasRole('admin')) {
            return $query;
        } elseif ($user->hasRole('doctor')) {
            return $query->where('doctor_id', $user->doctor?->id);
        } elseif ($user->hasRole('patient')) {
            return $query->where('patient_id', $user->patient?->id);
        } else {
            return $query->whereRaw('1=0');
        }
    }
}

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
}

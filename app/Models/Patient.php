<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'dob',
        'address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /** Scope for multi-role visibility **/
    public function scopeVisibleTo($query, $user)
    {
        if ($user->hasRole('admin')) {
            return $query;
        } elseif ($user->hasRole('doctor')) {
            // show only patients who have appointments with this doctor
            return $query->whereHas('appointments', fn($q) => $q->where('doctor_id', $user->doctor?->id));
        } elseif ($user->hasRole('patient')) {
            return $query->where('id', $user->patient?->id);
        } else {
            return $query->whereRaw('1=0');
        }
    }
}

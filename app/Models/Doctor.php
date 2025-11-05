<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'specialization',
        'fees',
        'photo',
        'availability',
        'slot_duration',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    /** Relationships **/
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
            return $query->where('user_id', $user->id);
        } else {
            return $query->whereRaw('1 = 0'); // hide from patients
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'is_read',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Scope for multi-role visibility **/
    public function scopeVisibleTo(Builder $query, $user)
    {
        if ($user->hasRole('admin')) {
            return $query;
        } else {
            return $query->where('user_id', $user->id);
        }
    }
}

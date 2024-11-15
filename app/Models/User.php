<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * @var string $table
     */
    protected $table = 'users';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'login',
        'password',
        'role',
        'photo',
        'club_id',
    ];

    /**
     * @var array $hidden
     */
    protected $hidden = [
        'password',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class, 'player_id');
    }

    public function tournaments(): HasMany
    {
        return $this->hasMany(Tournament::class, 'coordinator_id');
    }

    public function getAuthIdentifierName()
    {
        return 'login';
    }
}

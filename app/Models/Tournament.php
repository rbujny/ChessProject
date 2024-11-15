<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "start_date",
    ];

    public function results(): HasMany
    {
        return $this->hasMany(Result::class, 'tournament_id');
    }
}

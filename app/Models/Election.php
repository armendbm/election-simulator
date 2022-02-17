<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VotingSystem;

class Election extends Model
{
    use HasFactory;

    protected $casts = [
        'system' => VotingSystem::class,
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}

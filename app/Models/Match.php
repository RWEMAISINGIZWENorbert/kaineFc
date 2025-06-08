<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FootballMatch extends Model {
    protected $table = 'matches';

    protected $fillable = [
        'opponent_team',
        'match_date',
        'match_time',
        'venue',
        'match_type',
        'status',
        'home_team_score',
        'away_team_score',
        'referee',
        'notes',
    ];

    protected $casts = [
        'match_date' => 'date',
        'match_time' => 'datetime',
        'home_team_score' => 'integer',
        'away_team_score' => 'integer',
    ];

    public function matchResults(): HasMany
    {
        return $this->hasMany(MatchResult::class);
    }

    public function getFormattedMatchDateAttribute(): string
    {
        return $this->match_date->format('F j, Y');
    }

    public function getFormattedMatchTimeAttribute(): string
    {
        return $this->match_time->format('g:i A');
    }

    public function getScoreAttribute(): string
    {
        return "{$this->home_team_score} - {$this->away_team_score}";
    }
} 
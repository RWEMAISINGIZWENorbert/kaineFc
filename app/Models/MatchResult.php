<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchResult extends Model
{
    protected $fillable = [
        'match_id',
        'player_id',
        'goals_scored',
        'assists',
        'yellow_cards',
        'red_cards',
        'minutes_played',
        'performance_rating',
        'home_score',
        'away_score',
    ];

    protected $casts = [
        'goals_scored' => 'integer',
        'assists' => 'integer',
        'yellow_cards' => 'integer',
        'red_cards' => 'integer',
        'minutes_played' => 'integer',
        'performance_rating' => 'float',
        'home_score' => 'integer',
        'away_score' => 'integer',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(GameMatch::class, 'match_id');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function getScoreAttribute(): string
    {
        return "{$this->home_score} - {$this->away_score}";
    }
} 
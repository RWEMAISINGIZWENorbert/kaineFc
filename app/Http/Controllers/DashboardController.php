<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Staff;
use App\Models\GameMatch;
use App\Models\Team;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get counts for statistics with error handling
            $totalPlayers = Player::count() ?? 0;
            $totalStaff = Staff::count() ?? 0;

            // Get upcoming matches with team relationships and error handling
            $upcomingMatches = GameMatch::with(['homeTeam', 'awayTeam'])
                ->where('status', 'scheduled')
                ->where('match_date', '>=', now())
                ->orderBy('match_date')
                ->take(5)
                ->get();

            // Get recent matches with team and result relationships and error handling
            $recentMatches = GameMatch::with(['homeTeam', 'awayTeam', 'result'])
                ->where('status', 'completed')
                ->where('match_date', '<', now())
                ->orderBy('match_date', 'desc')
                ->take(5)
                ->get();

            // Get teams and positions for filters (if needed)
            $teams = Team::all();
            $positions = Position::all();

            // Debug information
            Log::info('Dashboard Data:', [
                'totalPlayers' => $totalPlayers,
                'totalStaff' => $totalStaff,
                'upcomingMatchesCount' => $upcomingMatches->count(),
                'recentMatchesCount' => $recentMatches->count()
            ]);

            return view('dashboard', compact(
                'totalPlayers',
                'totalStaff',
                'upcomingMatches',
                'recentMatches',
                'teams',
                'positions'
            ));
        } catch (\Exception $e) {
            Log::error('Dashboard Error: ' . $e->getMessage());
            
            // Return view with default values in case of error
            return view('dashboard', [
                'totalPlayers' => 0,
                'totalStaff' => 0,
                'upcomingMatches' => collect([]),
                'recentMatches' => collect([]),
                'teams' => collect([]),
                'positions' => collect([])
            ]);
        }
    }

    // Add dashboard methods here
} 

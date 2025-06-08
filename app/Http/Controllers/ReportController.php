<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Staff;
use App\Models\GameMatch;
use App\Models\MatchResult;
use App\Models\Attendance;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function playerStats(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subMonths(3));
        $endDate = $request->input('end_date', Carbon::now());

        $players = Player::with(['position', 'team'])
            ->withCount(['matches' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('match_date', [$startDate, $endDate]);
            }])
            ->get();

        return view('reports.player-stats', compact('players', 'startDate', 'endDate'));
    }

    public function staffAttendance(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());

        $staff = Staff::with(['role', 'department'])
            ->withCount(['attendance' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }])
            ->get();

        return view('reports.staff-attendance', compact('staff', 'startDate', 'endDate'));
    }

    public function matchResults(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subMonths(3));
        $endDate = $request->input('end_date', Carbon::now());

        $matches = GameMatch::with(['homeTeam', 'awayTeam', 'result'])
            ->whereBetween('match_date', [$startDate, $endDate])
            ->orderBy('match_date', 'desc')
            ->get();

        return view('reports.match-results', compact('matches', 'startDate', 'endDate'));
    }

    public function financial(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear());
        $endDate = $request->input('end_date', Carbon::now()->endOfYear());

        // This is a placeholder for financial data
        // You would need to implement actual financial tracking
        $financialData = [
            'revenue' => 0,
            'expenses' => 0,
            'profit' => 0,
            'categories' => [
                'ticket_sales' => 0,
                'merchandise' => 0,
                'sponsorships' => 0,
                'player_salaries' => 0,
                'staff_salaries' => 0,
                'facility_maintenance' => 0,
                'travel_expenses' => 0,
            ]
        ];

        return view('reports.financial', compact('financialData', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $type = $request->input('type');
        $format = $request->input('format', 'pdf');

        // Implement export logic based on type and format
        // This is a placeholder for export functionality
        return response()->json(['message' => 'Export functionality to be implemented']);
    }
} 
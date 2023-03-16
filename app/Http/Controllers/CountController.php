<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\Project;
use App\Models\employee;
use App\Models\EmployeeKpi;
use App\Models\kpi;
use App\Models\Role;
use App\Models\EmployeeProjectRole;

use Illuminate\Http\Request;

class CountController extends Controller
{
    public function count()
    {
        try {
            $count = Project::count();
            $count1 = Team::count();
            $count2 = Employee::count();

            return response()->json([$count, $count1, $count2], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update team.'], 500);
        }
    }
    public function lastsUpdate()
    {
        $lastTwoRows1 = Project::orderBy('id', 'desc')
            ->take(2)
            ->get();
        $lastTwoRows2 = Employee::with(['team'])->orderBy('id', 'desc')
            ->take(2)
            ->get();
        $lastTwoRows3 = Team::orderBy('id', 'desc')
            ->take(2)
            ->get();
        $lastTwoRows4 = kpi::orderBy('id', 'desc')
            ->take(2)
            ->get();
        $lastTwoRows5 = Role::orderBy('id', 'desc')
            ->take(2)
            ->get();

        return response()->json([$lastTwoRows1, $lastTwoRows2, $lastTwoRows3, $lastTwoRows4, $lastTwoRows5], 200);
    }
    public function Month()
    {
        try {
            $project = Project::select(Project::raw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) as count'))
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

                $team = Team::select(Team::raw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) as count'))
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();
                $employee = employee::select(employee::raw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) as count'))
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();
            return response()->json(['project:',$project,'team:',$team,'employee',$employee], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to get project.'], 500);
        }
    }
}

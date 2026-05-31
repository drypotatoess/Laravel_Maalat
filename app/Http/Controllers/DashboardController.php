<?php
 
namespace App\Http\Controllers;
 
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
 
class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPatients = Patient::count();
        $activeCases = Patient::where('status', 'Admitted')->count();
 
        // Bar chart - patients per month
        $patientsPerMonth = Patient::selectRaw('MONTH(date_of_visit) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
 
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $patientsPerMonth->has($i) ? $patientsPerMonth[$i]->count : 0;
        }
 
        // Pie chart - diagnoses
        $diagnoses = Patient::selectRaw('diagnosis, COUNT(*) as count')
            ->groupBy('diagnosis')
            ->orderByDesc('count')
            ->get();
 
        $thisMonth = Patient::whereMonth('date_of_visit', now()->month)
            ->whereYear('date_of_visit', now()->year)
            ->count();
 
        return view('dashboard', compact(
            'totalUsers',
            'totalPatients',
            'activeCases',
            'monthlyData',
            'diagnoses',
            'thisMonth'
        ));
    }
}
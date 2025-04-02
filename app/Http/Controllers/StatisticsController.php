<?php

namespace App\Http\Controllers;

use App\Models\OrdreMission;
use App\Models\RapportDeMission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        // Total counts
        $totalOrders = OrdreMission::count();
        $totalReports = RapportDeMission::count();
        $totalUsers = User::count();
        $totalFonctionnaires = User::where('role', 'fonctionnaire')->count();
        
        // Status statistics
        $ordersByStatus = OrdreMission::select('etatRemboursement', DB::raw('count(*) as total'))
            ->groupBy('etatRemboursement')
            ->get();
        
        // Monthly orders statistics (for the current year)
        $monthlyOrders = OrdreMission::select(
                DB::raw('MONTH(dateDebut) as month'), 
                DB::raw('count(*) as total')
            )
            ->whereYear('dateDebut', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Fill in missing months with zero
        $monthlyData = array_fill(1, 12, 0);
        foreach ($monthlyOrders as $order) {
            $monthlyData[$order->month] = $order->total;
        }
        
        // Top destinations
        $topDestinations = OrdreMission::select('destination', DB::raw('count(*) as total'))
            ->groupBy('destination')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
        
        // Recent activity
        $recentOrders = OrdreMission::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.statistics', compact(
            'totalOrders', 
            'totalReports', 
            'totalUsers',
            'totalFonctionnaires',
            'ordersByStatus', 
            'monthlyData',
            'topDestinations',
            'recentOrders'
        ));
    }
}
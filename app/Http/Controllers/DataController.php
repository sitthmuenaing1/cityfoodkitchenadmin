<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class DataController extends Controller
{
    public function index()
    {

        // Total Revenue
        $totalRevenue = DB::table('orders as o')
            ->join('menu as m', 'o.mid', '=', 'm.mid')
            ->select(DB::raw('COALESCE(SUM(o.quantity * m.price), 0) as total'))
            ->value('total');

        // Total Customers
        $totalCustomers = DB::table('users')->count();

        // Total Orders
        $totalOrders = DB::table('orders')->count();


        // Revenue per day (Line chart)
        $revenueData = DB::table('orders as o')
            ->join('menu as m', 'o.mid', '=', 'm.mid')
            ->select(
                DB::raw('DATE(o.ordertime) as date'),
                DB::raw('SUM(o.quantity * m.price) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top selling menu items (Bar chart)
        $topMenu = DB::table('orders as o')
            ->join('menu as m', 'o.mid', '=', 'm.mid')
            ->select(
                'm.mname',
                DB::raw('SUM(o.quantity) as total_sold')
            )
            ->groupBy('m.mname')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();


        return view('data', compact(
            'totalRevenue',
            'totalCustomers',
            'totalOrders',
            'revenueData',
            'topMenu'
        ));
    }
}
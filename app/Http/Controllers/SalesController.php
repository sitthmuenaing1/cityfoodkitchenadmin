<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        // Sorting (ASC / DESC)
        $order = $request->get('order') === 'asc' ? 'ASC' : 'DESC';
        $toggleOrder = $order === 'DESC' ? 'asc' : 'desc';

        // Sales Query (JOIN menu + orders)
        $sales = DB::table('orders as o')
            ->join('menu as p', 'o.mid', '=', 'p.mid')
            ->select(
                'o.orderid',
                'o.ordertime',
                'p.mname',
                'p.price',
                'o.quantity',
                'o.id',
                'o.payment',
                DB::raw('(o.quantity * p.price) as revenue')
            )
            ->orderBy('o.orderid', $order)
            ->get();

        // Total revenue
        $totalRevenue = $sales->sum('revenue');

        return view('sales', compact(
            'sales',
            'totalRevenue',
            'order',
            'toggleOrder'
        ));
    }
}
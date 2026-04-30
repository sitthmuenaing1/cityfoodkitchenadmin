<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
       
        $sort = $request->query('sort', 'desc');

 
        if (!in_array($sort, ['asc', 'desc'])) {
            $sort = 'desc';
        }

        
        $orders = DB::table('orders')
            ->join('menu', 'orders.mid', '=', 'menu.mid')
            ->join('users', 'orders.id', '=', 'users.id')
            ->select(
                'orders.orderid',
                'orders.ordernumber',
                'menu.mname',
                'orders.quantity',
                'orders.ordertime',
                'users.name as customer_name',
                'orders.phonenumber',
                'orders.billingaddress'
            )
            ->orderBy('orders.orderid', $sort)
            ->get();

        return view('orders', [
            'orders' => $orders,
            'sort' => $sort
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'asc'); 

        $customers = User::select('id', 'name', 'email')
            ->orderBy('id', $sort)
            ->get();

        return view('customers', compact('customers', 'sort'));
    }
}
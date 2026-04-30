<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    public function login()
    {
        return view('login');
    }

   public function loginPost(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
        'captcha' => 'required'
    ]);

   
    if ($request->captcha !== $request->captcha_answer) {
        return back()->with('error','Captcha incorrect');
    }

    $admin = \App\Models\Admin::where('username', $request->username)->first();


    if ($admin && $request->password == $admin->password) {

        \Auth::guard('admin')->login($admin);

        return redirect()->route('home');
    }

    return back()->with('error','Invalid username or password');
}
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

    public function home()
    {
        return view('home');
    }

    public function customers()
    {
        return view('customers');
    }

    public function orders()
    {
        return view('orders');
    }

    public function sales()
    {
        return view('sales');
    }

     public function data()
    {
        return view('data');
    }
}
<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('pages.customer.dashboard');
    }

    public function application()
    {
        return view('pages.customer.application');
    }
}
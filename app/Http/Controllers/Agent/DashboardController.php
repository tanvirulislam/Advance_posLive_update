<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use PDF;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
 {
      
        return view('agent.dashboard');
    }
}

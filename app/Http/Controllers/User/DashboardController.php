<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use PDF;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
 {
      
        return view('user.dashboard');
    }
}

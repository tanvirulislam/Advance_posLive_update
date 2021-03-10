<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use PDF;
use Brian2694\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
 {
      
        return view('merchant.dashboard');
    }
}

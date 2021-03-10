<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class UnitController extends Controller
{
    public function store(Request $request)
    {
    	$validdata=$request->validate([
    		'name' =>'required', 
    		
    	]);
     
    	$category=new Unit;
    	$category->name=$request->name;
    	$category->code='UC-'.rand('1000','9999');
        $category->save();
        
        Toastr::success('New Unit Added Successfully.');
        return redirect()->back();
       
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use App\Supplier;
use Illuminate\Support\Str;
use DB;


class SupplierController extends Controller
{

    public function create()
    {        
       
        return view('admin.supplier.create');
    }
    protected function imageUpload($request){
        $productImage = $request->file('image');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'public/uploads/sup_image/';
        $imageUrl = $directory.$imageName;
    
        Image::make($productImage)->resize( 150,150)->save($imageUrl);
    
        return $imageUrl;
      }

    public function store(Request $request)
    {
    	$validdata=$request->validate([
    		'name' =>'required', 
    		
    	]);
       if($request->file('image')!==null){
        $image=$this->imageUpload($request);
      }else{
         $image=null;
      }
    
    	$supplier=new Supplier;
        $supplier->company=$request->company;
        $supplier->mobile=$request->mobile;
    	  $supplier->name=$request->name;
        $supplier->email=$request->email;
        $supplier->address=$request->address;
        $supplier->image=$image;
        $supplier->status=$request->status;
    	
        $supplier->save();
        Toastr::success('New Supplier Added Successfully.');
          return redirect()->back();
       
    }
}

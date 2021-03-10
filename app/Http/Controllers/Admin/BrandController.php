<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Brand;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class BrandController extends Controller
{
    protected function imageUpload($request){
        $productImage = $request->file('image');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'public/uploads/brand_image/';
        $imageUrl = $directory.$imageName;
    
        Image::make($productImage)->resize( 80,80)->save($imageUrl);

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
    
    	$category=new Brand;
    	$category->name=$request->name;
    	$category->company=$request->company;
    	$category->code='BC-'.rand('1000','9999');
        $category->image=$image;
    	$category->slug=Str::slug($request->name);
        $category->status=$request->status;
        $category->save();
        Toastr::success('New Brand Added Successfully.');
          return redirect()->back();
       
    }
}

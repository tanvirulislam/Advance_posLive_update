<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Category;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{

  protected function imageUpload($request){
    $productImage = $request->file('image');
    $imageName = $productImage->getClientOriginalName();
    $directory = 'public/uploads/';
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
   
   $category=new Category;
   $category->name=$request->name;
   $category->code='CC-'.rand('1000','9999');
   $category->image=$image;
   $category->slug=Str::slug($request->name);
   $category->status=$request->status;
   $category->parentId=$request->parentId;
   $category->save();
   Toastr::success('New Category Added Successfully.');
   return redirect()->back();
   
 }
}

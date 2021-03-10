<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Subcategory;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class SubcategoryController extends Controller
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
   
   $category=new Subcategory;
   $category->name=$request->name;
   $category->parentId=$request->parentId;
   $category->code='SCC-'.rand('1000','9999');
   $category->image=$image;
   $category->slug=Str::slug($request->name);
   $category->status=$request->status;
   $category->save();
   Toastr::success('New Sub-Category Added Successfully.');
   return redirect()->back();
   
 }

 public function selectSubcategory(Request $request){
   
  $subcategory=DB::table('subcategories')->where('parentId',$request->catId)->get();

  return response()->json($subcategory);

  }

}

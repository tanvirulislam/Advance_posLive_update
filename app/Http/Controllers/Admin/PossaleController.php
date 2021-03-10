<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use App\Brand;
use App\Customer;
use App\ChequeInfo;
use App\Subcategory;
use App\CustomerCategory;
use App\Excategory;
use App\Unit;
use App\Supplier;
use App\Sell;
use App\SalesProduct;
use App\Expense;
use App\System;
use Cart;
use Image;
use Session;
use App\Admin;
use App\Payment;
use App\Stock;
use Illuminate\Support\Str;

class PossaleController extends Controller
{
    public function index(){
  
        
     $customers=Customer::all();
     $allProducts=Product::all();
     $categories=Category::all();
     $brands=Brand::all();
     $expenseCats=Excategory::all();
     $subcategories=Subcategory::all();
     $customerGroups=CustomerCategory::all();
     $suppliers=Supplier::all();
     $units=Unit::all();
     
     return view('admin.pos.posScreen')->with([
       'allProducts'=>$allProducts,
       'categories'=>$categories,
       'brands'=>$brands,
       'customers'=>$customers,
       'subcategories'=>$subcategories,
       'customerGroups'=>$customerGroups,
       'expenseCats'=>$expenseCats,
       'suppliers'=>$suppliers,
       'units'=>$units,
      
     ]);
   }

   public function setCustomer(Request $request){
       
        $id=$request->customerId;
        $name=DB::table('customers')->where('id',$id)->value('name');
        $mobile=DB::table('customers')->where('id',$id)->value('mobile');
        Session::put('customer', $id);
        Session::put('customerName', $name.'('.$mobile.')');
        return 1;
    }
    //reset customer
    public function customerReset(Request $request){

        if($request->ctype==1){
            session()->forget('customer');  
            session()->forget('customerName'); 
            return 1;
        }
    }

    public function addCustomer(Request $request){

        $request->validate([
        'mobile'=>'required',
        'name'=>'required',
        ]);
        $customer=new Customer;
        $customer->mobile=$request->mobile;
        $customer->name=$request->name;
        $customer->group=$request->group;
        $customer->email=$request->email;
        $customer->address=$request->address;
        $customer->company=$request->company;
        
        $customer->save();
        
        $id=$customer->id;
        $name=DB::table('customers')->where('id',$id)->value('name');
        $mobile=DB::table('customers')->where('id',$id)->value('mobile');
        Session::put('customer', $id);
        Session::put('customerName', $name.'('.$mobile.')');
            Toastr::success('Customer added successfully');
        return redirect()->route('admin.sale-pos');
 
    }

    public function CustomerDetails(Request $request){
  
        if(!empty($request->customer_id)){
          $totalShopping=DB::table('sells')->where('customer_id',$request->customer_id)->sum('grand_total');
          $totalDue=DB::table('sells')->where('customer_id',$request->customer_id)->sum('due');
          $customerInfo=DB::table('customers')->where('id',$request->customer_id)->first();
          $paymentInfo="";
          return view('backend.pos.customerInfo')->with(['customerInfo'=>$customerInfo,'paymentInfo'=>$paymentInfo,'totalShopping'=>$totalShopping,'totalDue'=>$totalDue]);
      
        }else{
          echo "Please select a customer.";
        }

      }

      public function addToCart(Request $request){  

            Cart::setGlobalTax(0);
            Cart::setGlobalDiscount(0);
            $product_name=DB::table('products')->where('id', $request->pro_id)->value('name'); 
            $product_id=DB::table('products')->where('id', $request->pro_id)->value('id');
            $purchase_price=DB::table('products')->where('id', $request->pro_id)->value('sell_price');
            Cart::add($product_id, $product_name, 1, $purchase_price);
            return view('backend.pos.cartProduct');

    }

    public function productSave(Request $request){

        $request->validate([
               'name'=>'required|unique:products',
               'purchase_price'=>'required',
               'sell_price'=>'required',
               'unit'=>'required',
           ]);

             //dd($request->discount);
		if($request->product_discount == 1){
			if($request->discount == 3){
            //dd($request->discount);

				$percentage_price= $request->manual_discount;
				$sell_prices= $request->sell_price;
				$manual_discountt = $percentage_price / 100 * $sell_prices;
				$manual_discount = $sell_prices- $manual_discountt;

			}
			else{

				$manual_price = $request->manual_discount;
				$sell_prices= $request->sell_price;
				$manual_discount = $sell_prices - $manual_price;

			}

		}
		else{

			$manual_discount= $request->sell_price;
		}

        //dd($manual_discount);
          
          if($request->file('image')!==null){
               $image=$this->imageUpload($request);
             }else{
                $image=null;
             }
           $product=new Product;
           $product->name=$request->name;
           $product->code='PC-'.rand('1000','9999');
           $product->slug=Str::slug($request->name);
           $product->supplier=$request->supplier;
           $product->unit=$request->unit;
           $product->date=date('Y-m-d');
           $product->brand=$request->brand;
           $product->start_inventory=$request->start_inventory;
           $product->start_cost=$request->start_inventory*$request->purchase_price;
           $product->category=$request->category;
           $product->subcategory=$request->subcategory;
           $product->purchase_price=$request->purchase_price;
           $product->alert_qty=$request->alert_qty;
           $product->sell_price=$manual_discount;
           $product->whole_price=$request->sell_price;
           $product->description=$request->description;
           $product->discount=$request->discount;
           $product->image = $image;
           $product->save();
       
               $proId=$product->id;
               $stock=new Stock;
               $stock->pro_id=$proId;
               $stock->stock=1;
               $stock->alert_qty=$request->alert_qty;
               $stock->save();
       
         Toastr::success('Product Added Successfully.');
         return redirect()->route('admin.sale-pos');
       
       
       }



}

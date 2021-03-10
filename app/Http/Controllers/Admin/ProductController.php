<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;
use App\Supplier;
use App\Unit;
use App\Brand;
use App\Category;
use App\Product;
use App\Stock;
use App\Purchase;
use App\Payment;
use App\PurchaseProductList;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductController extends Controller
{
	public function index(){
		$suppliers=Supplier::all();
		$units=Unit::all();
		$categories=Category::all();
		$brands=Brand::all();
		$products=Product::all();

		return view('admin.product.index', compact('suppliers', 'units', 'categories', 'brands', 'products'));
	}

	public function create(){
		
		$suppliers=Supplier::all();
		$units=Unit::all();
		$categories=Category::all();
		$brands=Brand::all();
		$products=Product::all();

		return view('admin.product.create', compact('suppliers', 'units', 'categories', 'brands', 'products'));

	}

	protected function imageUpload($request){
		$productImage = $request->file('image');
		$imageName = $productImage->getClientOriginalName();
		$directory = 'public/uploads/product_image/';
		$imageUrl = $directory.$imageName;
		
		Image::make($productImage)->resize( 80,80)->save($imageUrl);

		return $imageUrl;
	}
	public function store(Request $request){
        // dd($request);
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
		$product->whole_price=$request->whole_sell;
		$product->description=$request->description;
		$product->discount=$request->discount;
		$product->image = $image;

		$product->save();

		$proId=$product->id;
		$stock=new Stock;
		$stock->pro_id=$proId;
		$stock->stock=$request->start_inventory;
		$stock->alert_qty=$request->alert_qty;
		$stock->save();

		$purchase=new Purchase;
		$total_purchase = $request->start_inventory * $request->purchase_price;
		$purchase->code='PUC-'.rand('1000','9999');
		$purchase->grand_total=$total_purchase;
		$purchase->paid_amount=$total_purchase;
		$purchase->due=0;
		$purchase->discount=0;
		$purchase->purchase_date=date('Y-m-d');
		$purchase->reference="NULL";
		
		
		$purchase->supplier_id=$request->supplier;
		$purchase->is_received=1;
		$purchase->note="null";
		$purchase->documents="null";
		$purchase->import_by=Auth::user()->id;
		$purchase->save();

		$code= $purchase->code;
		$purchase_id=$purchase->id;


		$pay=Payment::all();
		$pay=count($pay)+1;
		$paycode='PAY-'.date('Y-m-d').'/'.$pay;

		$payment=New Payment;
		$payment->reference=$paycode;
		$payment->purchasereference=$code;
		$payment->type='paid';
		$payment->amount=$total_purchase;
		$payment->paidBy="Cash";
		$payment->pDate=date('Y-m-d');
		$payment->transectionBy=Auth::user()->id;
		$payment->save();


		
		$purchaseProduct=new PurchaseProductList;

		$purchaseProduct->purchase_id=$purchase_id;
		$purchaseProduct->pro_id=$proId;
		$purchaseProduct->qty=$request->start_inventory;
		$purchaseProduct->unit_price=$request->purchase_price;;
		$purchaseProduct->subtotal=$total_purchase;
		
		$purchaseProduct->save();

		Toastr::success('Product Added Successfully.');
		return redirect()->back();
		

	}

	//get product details by id
    public function view(Request $request){

      $id=$request->pro_id;
        $productInfo=DB::table('products')
        ->leftjoin('categories','categories.id','=','products.category')
        ->leftjoin('brands','brands.id','=','products.brand')
        ->leftjoin('units','units.id','=','products.unit')
        ->leftjoin('stocks','stocks.pro_id','=','products.id')
        ->select('products.*','categories.name as catName','brands.name as bName','units.name as uName','units.id as unit','stocks.stock as Stock')
        ->where('products.id',$id)->first();
        
       
        return view('admin.product.view')->with([ 'productInfo'=>$productInfo,
          
        ]);
    }

	public function delete($id)
    {
    	
         Product::where('id', '=', $id)->delete();
         Toastr::warning('Successfully Deleted :)','Success');
         return redirect()->back();
    }


}

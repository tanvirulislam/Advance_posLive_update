<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use Cart;
use App\Supplier;
use App\Product;
use App\Purchase;
use App\Stock;
use App\PurchaseProductList;
use App\Payment;

class PurchaseController extends Controller
{
    public function index()
    {
    	
        $suppliers=Supplier::all();
        $products =Product::latest()->get();
        $purchaseLists=Purchase::latest()->get();
        return view('admin.purchase.index', compact('products','suppliers','purchaseLists'));
    }

    public function create(){

        $suppliers=Supplier::all();

        $products=Product::all();

        return view('admin.purchase.create')->with([ 'suppliers'=>$suppliers, 'products'=>$products, ]);
    }


    public function productAddTopurchase(Request $request)
    {

            //Products::findOrfail('id',$request->pro_id);
    $product_name=DB::table('products')->where('id', $request->pro_id)->value('name'); 
    $product_id=DB::table('products')->where('id', $request->pro_id)->value('id');
    $purchase_price=DB::table('products')->where('id', $request->pro_id)->value('purchase_price');
    Cart::add($product_id, $product_name, 1, $purchase_price);
    return 1;

    }

    public function removeItem($rowId)
    {
    Cart::remove($rowId);
    return redirect()->route('admin.purchase.create');
    }


    public function removeAllItem()
    {
    Cart::destroy();
    return redirect()->route('admin.purchase.create');
    }


    public function updateQty(Request $request) {
        $rowId=$request->rowId;
        $qty=$request->qty;
        Cart::update($rowId, ['qty' => $qty]); 

    }

    public function updateProductQuantity(Request $request) {
        $request->validate([
        'rowId'=>'required',
        'quantity'=>'required',
        ]);
        Cart::update($request->rowId, 2); 
                //Cart::update($request->rowId, ['qty' =>$request->quantity]);
        return 1;
    }


public function store(Request $request)
{

  $request->validate([

    
   'supplier_id'=>'required',

 ]);
  
    //uploads file
  if($request->hasFile('documents'))
  {
    $image_name = $request->file('documents');
    $random_name = $image_name->getClientOriginalName();

    $directory = 'public/uploads/purchase_document';
    $dbfile = $directory.$random_name;
    $image_name->move($directory, $dbfile);
    $documents= $dbfile;

  }else{
    $documents=null;
  }

  $due=$request->grand_total-($request->paid_amount+$request->discount);

  //$purchaseProduct=new PurchaseProductList;
  $purchase=new Purchase;
  $purchase->code='PUC-'.rand('1000','9999');
  $purchase->grand_total=$request->grand_total;
  $purchase->paid_amount=$request->paid_amount;
  $purchase->due=$due;
  $purchase->discount=$request->discount;
  $purchase->purchase_date=date('Y-m-d');
  $purchase->reference=$request->reference;
  
  $purchase->supplier_id=$request->supplier_id;
  $purchase->is_received=$request->is_received;
  $purchase->note=$request->note;
  $purchase->documents=$documents;
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
  $payment->amount=$request->paid_amount;
  $payment->paidBy=$request->paidBy;
  $payment->pDate=date('Y-m-d');
  $payment->transectionBy=Auth::user()->id;
  $payment->save();


  foreach(Cart::content() as $product){
    $purchaseProduct=new PurchaseProductList;
    $pro_id=$product->id;
    $pro_qty=$product->qty;

    $stock=DB::table('stocks')->where('pro_id',$pro_id)->value('stock');
    $update_stock=$stock+$pro_qty;

    $purchaseProduct->purchase_id=$purchase_id;
    $purchaseProduct->pro_id=$pro_id;
    $purchaseProduct->qty=$pro_qty;
    $purchaseProduct->unit_price=$product->price;
    $purchaseProduct->subtotal=$product->subtotal;
    
    $purchaseProduct->save();

    DB::table('stocks')->where('pro_id',$pro_id)->update(['stock'=>$update_stock,'last_import'=>$pro_qty]);
    

    }//end foreach loop


Toastr::success('Purchase added Successfully.');
Cart::destroy();

return redirect()->route('admin.purchase'); 

}


public function purchaseDetails(Request $request){

    $id=$request->purchase_id;
    $billInfo=DB::table('purchases')
    ->leftjoin('suppliers','suppliers.id','=','purchases.supplier_id')
    ->select('purchases.*','suppliers.name','suppliers.email','suppliers.address','suppliers.mobile')
    ->where('purchases.id',$id)
    ->first();
    $billProduct=DB::table('purchase_product_lists')
    ->join('products','products.id','=','purchase_product_lists.pro_id')
    ->select('purchase_product_lists.*','products.name')
    ->where('purchase_product_lists.purchase_id',$id)
    ->get();              
    return view('admin.purchase.purchaseDetails')->with(['billInfo'=>$billInfo,'billProduct'=>$billProduct]);
}

    public function delete($id){


       
    
    
        $code= DB::table('purchases')->where('id',$id)->value('code');

        DB::table('payments')->where('purchasereference',$code)->delete();

        DB::table('purchases')->where('id',$id)->delete();

        DB::table('purchase_product_lists')->where('purchase_id',$id)->delete();
        Toastr::success('Purchase deleted');
        return redirect()->back();
    
    }
}

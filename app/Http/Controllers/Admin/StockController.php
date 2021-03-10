<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use DB;
use App\stock;

class StockController extends Controller
{
    public static function stock($id)
    {
      $total_purchase=DB::table('purchase_product_lists')->where('pro_id',$id)->sum('qty');
      $total_sell=DB::table('sales_products')->where('pro_id',$id)->sum('qty');
      $start=DB::table('products')->where('id',$id)->value('start_inventory');
      $stock=($start+$total_purchase)-$total_sell;
      return $stock;
    }
    //return total low stock product
    public static function numberOfLowStockProduct()
    {
      $lowStock=0;
      $allProduct=Product::all();
      foreach($allProduct as $product){
        $stock=StockController::stock($product->id);
        
        if($stock<$product->alert_qty){
          $lowStock+=1;
        }
      }
      return $lowStock;
    }
    //low stock products

    public function lowStockProduct()
    {
      $products = Product::get();
    //   dd($products);
      return view('admin.product.lowStockProduct')->with([
             'products'=>$products,
             

        ]);
    }
}

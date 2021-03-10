<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function brandInfo()
   {
   	return $this->belongsTo('App\Brand','brand');
      
   }

   public function categoryInfo()
   {
   	return $this->belongsTo('App\Category','category');
   }
    public function unitInfo()
   {
   	return $this->belongsTo('App\Unit','unit');
   }
   public function stockInfo()
   {
      return $this->belongsTo('App\Stock','id','pro_id');
   }
   public function SalesProductInfo()
   {
      return $this->belongsTo('App\SalesProduct','id','pro_id');
   }
   public function supplierInfo()
   {
      return $this->belongsTo('App\Supplier','supplier','id');
   }
}

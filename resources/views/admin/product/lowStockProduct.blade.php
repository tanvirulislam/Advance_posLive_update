@extends('admin.master.master')
@section('title')
Product
@endsection
@section('style')

@endsection

@section('body')
<?php use App\Http\Controllers\Admin\StockController;

?>
<br><br><br>
<div id="content" class="content">
  <div class="container">
    <div class="row">
     <div class="card" >
      <div class="card-body">
       <h4 class="header-title">Low stock Product</h4>
       <div class="data-tables datatable-primary">
        <div class="table-responsive">
          <table id="table_id" class="table table-hover table-responsive text-center ">
            <thead class="text-capitalize thead-light">
              <tr>
               <th class="font-weight-bold" scope="col">#</th>
               <th class="font-weight-bold" scope="col">Image</th>
               <th class="font-weight-bold" scope="col">Name</th>
               <th class="font-weight-bold" scope="col">Code</th>
               <th class="font-weight-bold" scope="col">Brand</th>
               <th class="font-weight-bold" scope="col">Supplier</th>
               <th class="font-weight-bold" scope="col">Cost</th>
               <th class="font-weight-bold" scope="col">Price</th>
               <th class="font-weight-bold" scope="col">Unit</th>
               <th class="font-weight-bold" scope="col">Alert Quantity</th>
               <th class="font-weight-bold" scope="col">Stock</th>
               <th class="font-weight-bold" scope="col">Actions</th>
             </tr>
           </thead>
           <tbody>
            <?php $counter=0;?>
            @foreach($products as $product)
            <?php 
            $stock=StockController::stock($product->id);
            ?>
            @if($stock<$product->alert_qty)
            <?php $counter++;?>
            <tr>
              <td>{{$counter}}</td>
              <td>
                @if(!empty($product->image))
                <img src="{{ asset('/')}}{{$product->image}}" alt="{{$product->name}}" class="img-rounded" style="width:35px;height:35px;">
                @else
                <img src="{{ asset('/')}}public/admin/defaultIcon/no_image.png" alt="No-image" class="img-rounded" style="width:35px;height:35px;">
                @endif
              </td>
              <td>{{$product->name}}</td>
              <td>{{$product->code}}</td>
              <td>{{$product->brandInfo['name']}}</td>
              <td title="Company-{{$product->supplierInfo['company']}}, Mobile- {{$product->supplierInfo['mobile']}}">{{$product->supplierInfo['name']}}</td>
              <td style="text-align: right;">{{number_format($product->purchase_price)}}</td>
              <td style="text-align: right;">{{number_format($product->sell_price)}}</td>
              <td>{{$product->unitInfo['name']}}</td>
              
              <td style="text-align: right;">{{$product->alert_qty}}</td>
              <td style="text-align: right;">
                @if($stock<$product->alert_qty && $stock >0)
                <p style="color:yollow;" class="">{{$stock}}</p>
                @elseif($stock <=0)
                <p style="color:red;" class="">{{$stock}}</p>
                @else
                <p style="color:green;" class="">{{$stock}}</p>
                @endif
              </td>
              <td style="width:120px;">
                <div class="dropdown" style="width:90px;float:right;">
                  
                  
                  <a href="{{route('admin.stock.lowStock.addStock',$product->id)}}" class="action-btn px-1">
                    Add Stock
                  </a>
                  
                </div>
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


</div>
</div>
<!-- page title area end -->

@endsection
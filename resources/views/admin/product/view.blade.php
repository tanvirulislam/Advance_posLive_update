

<div class="modal-header">
  <h2 class="modal-title" id="exampleModalLabel">Product Information</h2>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<div class="modal-body">                                          
 <div class="row p-1">
  <div class="col-2">
   <center>
    @if(!empty($productInfo->image))
    <img src="{{ asset('/')}}{{$productInfo->image}}" alt="{{$productInfo->name}}" class="img-rounded" style="width:100px;height:100px;">
    @else
    <img src="{{ asset('/')}}public/admin/defaultIcon/no_image.png" alt="No-image" class="img-rounded" style="width:100px;height:100px;">
    @endif
    
  </center>
</div>
<div class="col-5 col-xs-12">
 <h3><b>Basic Information</b></h3>
 <hr class="mt-0">
 <p class="mb-0">Name: {{$productInfo->name}}</p>
 <p class="mb-0">Code: {{$productInfo->code}}</p>
 <p class="mb-0">Category: {{$productInfo->catName}}</p>
 <p class="mb-0">Brand: {{$productInfo->bName}}</p>
 <p class="mb-0">Weight: {{$productInfo->weight}}  {{$productInfo->uName}}</p>
 <p class="mb-0">Alert Quantity: {{$productInfo->alert_qty}} </p>
 <hr>
 <p>{{$productInfo->description}}</p>
 
</div>
<div class="col-5 col-xs-12">
 <h6><b>Purchase / Sales  Information</b></h6>
 
 <hr class="mt-0">
 <p class="mb-0">Purchase Price: ৳{{number_format($productInfo->purchase_price)}}</p>
 <p class="mb-0">Sell Price: ৳{{number_format($productInfo->sell_price)}} <span class="mb-0 badge badge-success">
  @if($productInfo->discount == 1)

  discount price
  @else
  normal price
  @endif
</span></p>
<p class="mb-0">Whole Sell Price: ৳{{number_format($productInfo->whole_price)}}</p>
<p class="mb-0">Start Inventory: {{number_format($productInfo->start_inventory)}} </p>
<p class="mb-0">Total Purchase: </p>
<p class="mb-0">Total Sale: </p>
<?php $counter=0;?>
<?php $counter++;
$stock=StockController::stock($product->id);
?>
@if($stock<$productInfo->alert_qty && $stock >0)
<p class="badge badge-warning">{{$stock}}</p>
@elseif($stock <=0)
<p class="badge badge-danger">{{$stock}}</p>
@else
<p class="badge badge-success">{{$stock}}</p>
@endif
<p class="mb-0 badge badge-success">In Stock:{{number_format($productInfo->Stock)}} </p><br>


</div>

</div>
</div>
</div>


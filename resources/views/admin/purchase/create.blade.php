@extends('admin.master.master')
@section('title')
Create Purchase
@endsection
@section('style')

@endsection

@section('body')
<br>
<br><br>
<div id="content" class="content">
  <div class="container" >
    <div class="row">
        
        <!-- data table start -->
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header" style="background-color: darkseagreen;">
                    <h6>Products</h6>

                    

                </div>
            </div>
        </div>
        
        <!-- data table end -->
            <div class="form-row">
                <div class="form-group col-md-12">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text p-0" style="margin-top:-3px;"><p class="btn btn-primary mb-0 py-1 proAddBtn" style="border-radius:0px;font-size:20px;cursor:pointer;">+</p></div>
                        </div>
                        <select class="custom-select form-control" id="pro_id">
                            <option selected>Select Product</option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-hover table-striped" id="records_table">
                <thead class="blue-table-head">
                    <tr>
                        <th class="font-weight-bold" scope="col">#</th>
                        <th class="font-weight-bold" scope="col">Product(Code-Name)</th>
                        <th class="font-weight-bold" scope="col">Unit Cost</th>
                        <th class="font-weight-bold" scope="col">Quantity</th>

                        <th class="font-weight-bold" scope="col">Subtotal</th>
                        <th class="font-weight-bold" scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price=0;
                    $total_product=0;
                    $counter=0;
                    ?>
                    @foreach(Cart::content() as $product)
                    <?php
                    $counter++;
                    $total_price+=$product->subtotal;
                    $total_product+=$product->qty;
                    ?>
                    <tr>
                        <td>{{$counter}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{number_format($product->price)}}</td>
                        <td >
                            <input type="text" style="width:40px;" value="{{$product->qty}}" class="pro_qty" data-qty="{{$product->rowId}}">

                        </td>

                        <td>{{number_format($product->subtotal)}}</td>
                        <td>
                            <a href="{{route('admin.purchase.removeItem',$product->rowId)}}"><i class="fa fa-times-circle" title="Remove Item"></i></a>
                        </td>
                    </tr>

                    @endforeach
                    @if(!Cart::content()->isEmpty())
                    <tr style="font-weight:bold;">
                        <td  colspan="3">TOTAL</td>
                        <td>{{$total_product}}</td>
                        <td>
                            {{number_format($total_price)}}
                        </td>
                        <td><a href="{{route('admin.purchase.removeAllItem')}}" class="btn btn-danger py-0" style="color:white;border-radius:0px; " title="All product remove from list">All Clear</a></td>


                    </tr>

                    @endif
                </tbody>
            </table>
            <form method="post" action="{{route('admin.purchase.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-row pt-2 pb-4 mb-3" style="background: cornflowerblue;">
                   <div class="row"|>
                        <div class="form-group col-md-4">
                            <label style="color:white;">Paying By</label>
                            <select name="paidBy" class="form-control">
                                <option value="cash">Cash</option>

                            </select>

                        </div>

                        <div class="form-group col-md-4">
                            <label style="color:white;">Payment</label>
                            <input type="number" class="form-control" name="paid_amount" placeholder="Paid Amount">
                            <input type="hidden" name="grand_total" value="{{$total_price}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color:white;">Discount</label>
                            <input type="number" class="form-control" name="discount" placeholder="discount">

                        </div>
                   </div>

                </div>
                <hr>
                <div class="form-row">

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Reference</label>
                            <input type="Text" class="form-control" name="reference" placeholder="Reference">
                        </div>


                        <div class="form-group col-md-4">
                            <label>Supplier *</label>
                            <select class="custom-select form-control" name="supplier_id">
                                <option selected>Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->company}}({{$supplier->name}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Product Received ?</label>
                            <select class="custom-select form-control" name="is_received">
                                <option value="1">Received</option>
                                <option value="0">Not Received</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Document</label>
                        <input type="file" class="form-control"name="documents">

                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label>Note</label>
                    <textarea class="form-control" name="note" rows="3"></textarea>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <br>
            </div>
        </form>
        
    </div>

</div>
</div>
</div>

@endsection
@section('scipts')
<script>
 $(document).ready(function(){

        //add productr to purchase list 
        $(".proAddBtn").click(function(){
            var pro_id=$("#pro_id").val();
     //ajax

     $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{route('admin.purchase.productAddToPurchase')}}",
        type:"POST",
        data:{'pro_id':pro_id},
        //dataType:'json',
        success:function(data){
            console.log(data);
            if(data==1){
                location.reload(true);
            }else{
                alert('Something Went wrong Please Try Again.');
            }

        },
        error:function(){
            alert("Please selected a product");
        }
    });
     //endajax
 });


        //update product qty
        $(".pro_qty").on('change',function(){
            var rowId=$(this).data('qty');
            var qty=$(this).val();
            if($.isNumeric(qty)){
//ajax
if(qty!=0){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{route('admin.purchase.updateQty')}}",
        type:"POST",
        data:{'rowId':rowId,'qty':qty},
        //dataType:'json',
        success:function(data){
            location.reload(true);
        },
        error:function(){
            alert("Something Went wrong.Please try again.");
        }
    });
}
  //end ajax
}else{
    alert('Please Enter Correct Number.');
}
}); 


    });
</script>
@endsection
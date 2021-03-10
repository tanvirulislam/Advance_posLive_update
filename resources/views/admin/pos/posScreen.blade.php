@extends('admin.master.master')
@section('title')
Pos-sale
@endsection
@section('style')

@endsection

@section('body')
<br><br><br>
<div id="content" class="content">
	<div class="container" >
        <div class="row">
         <div class="col-2">

            <button class="btn btn-primary bill_preview" style="background:#17a2b8 !important" title="Bill Preview" data-toggle="modal" data-target=".bill_modal">
            <i class="fa fa-sticky-note"></i>
            </button>

            </div>
            <div class="col-2">
            <li class="btn btn-warning todaySale" style="background:#78cd51 !important" title="Today's Sale" data-toggle="modal" data-target=".todaysale_modal">
            <i class="fa fa-heart"></i>


            </li>
            </div>
            <div class="col-2">
            <li class="btn btn-danger profitloss" style="background:green !important" title="Today Profit/Loss" data-toggle="modal" data-target=".profit">
            <i class="fa fa-hourglass-start"></i>


            </li>
            </div>
            <div class="col-3">
            </div> 
        </div>

        <div class="row">
        <!-- Primary table start -->
            <div class="col-md-9 mt-5" style="background-color: darkgray;">
                <div id="left-top" class="mt-2">

                    <div class="form-group">
                        <div class="input-group" style="z-index:1;">
                        <div class="row mb-3">

                        <div class="col-md-9">
                                @if(Session::has('customer'))
                                <select class="form-control pos-input-tip" name="customer" value=""  id="poscustomer">
                                    <option value="{{Session::get('customer')}}">{{Session::get('customerName')}}</option>
                                    
                                </select>
                                @else
                                <select class="form-control pos-input-tip" name="customer" value=""  id="poscustomer">
                                    <option value="" readonly="">Select customer or search by mobile</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile}})</option>
                                    @endforeach
                                </select>
                                @endif
                        </div>
                            
                            <div class="col-md-1">
                                <div class="input-group-addon no-print customer_btn">
                                    <a href="#"><i class="fa fa-plus-circle" id="addIcon"  data-toggle="modal" data-target=".customer_modal" title="Add new Customer"></i></a>
                                </div>
                            </div>
                            <div class="col-md-1">

                                <div class="input-group-addon no-print customer_btn">
                                    <a href="#" class="view_customer"><i class="fa fa-eye" id="addIcon" data-toggle="modal" data-target=".customer_details_modal" title="Customer Details"></i></a>
                                </div>
                            </div>
                            <div class="col-md-1">

                                <div class="input-group-addon no-print customer_btn customerReset" id="toogle-customer-read-attr">
                                    <a href="#"><i class="fa fa-edit" id="addIcon" ></i></a>
                                </div>
                            </div>

                        </div>
                        </div>

                        <div style="clear:both;"></div>
                    </div>

                </div>

                <div class="no-print">
                    <div class="form-group" id="ui">
                        <div class="input-group" style="z-index:1;">
                        <div class="row">
                            <div class="col-md-9">
                            <input type="text" name="customer" value=""  id="posProduct" required="required" class="form-control pos-input-tip barcode" placeholder="Scan/search product name/code" title="Scan/Search product name/code"/>

                            </div>
                            <div class="col-md-3">
                            <div class="input-group-addon no-print product_btn">
                                <a href="#" id="view-customer"><i class="fa fa-plus-circle" id="addIcon"  data-toggle="modal" data-target=".product_modal" title="Add new Product"></i></a>
                            </div>
                            </div>
                        
                        </div>

                            


                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            <!--End left top-->

            </div>

           


        </div>

<!--Customer Modal -->
<div class="modal fade bd-example-modal-lg customer_modal" tabindex="-1" role="dialog" aria-labelledby="customer_modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Add New Customer</h2>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <div class="modal-body">

       <form id="customerForm" method="post" action="{{route('admin.pos.addCustomer')}}">
        @csrf
        <div class="form-row">

          <div class="form-group col-md-6">
            <label>Customer Group</label>
            <select class="custom-select form-control" name="group">
              @foreach($customerGroups as $customerGroup)
              <option value="{{$customerGroup->id}}">{{$customerGroup->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Mobile *</label>
            <input type="text" class="form-control" name="mobile" placeholder="Enter Customer Mobile">
          </div>
          <div class="form-group col-md-6">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Customer Name">
          </div>
          <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter Customer Email Address">
          </div>
          <div class="form-group col-md-6">
            <label>Company</label>
            <input type="text" class="form-control" name="company" placeholder="Enter Customer Company Name">
          </div>
          <div class="form-group col-md-6">
            <label>Address</label>
            <input type="text" class="form-control" name="address" placeholder="Enter Customer Address">
          </div>



        </div>

      </div>
      <div class="modal-footer">


        <input type="submit" class="btn btn-primary" value="Add Customer" id="saveCustomer" style="border-radius: 0px;">
      </form>

    </div>
  </div>
</div>
</div>

<!--Customer details modal-->
<div class="modal fade bd-example-modal-lg customer_details_modal" tabindex="-1" role="dialog" aria-labelledby="customer_details_modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Customer Details</h2>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <div class="modal-body row" id="customer_details">


      </div>

    </div>
  </div>
</div>

<!--Product modal-->
<div class="modal fade bd-example-modal-lg product_modal" tabindex="-1" role="dialog" aria-labelledby="product_modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Add New Product</h2>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <div class="modal-body">

        <form method="post" action="{{route('admin.pos.productSave')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-row">

          <div class="row">
            <div class="form-group col-md-6">
              <label for="formGroupExampleInput2">Supplier</label>
              <select class="custom-select form-control" name="supplier">
               @foreach($suppliers as $supplier)
               <option value="{{$supplier->id}}">{{$supplier->company}}({{$supplier->name}})</option>
               @endforeach
             </select>
           </div>
           <div class="form-group col-md-6">
            <label>Product Name *</label>
            <input type="text" class="form-control" name="name" placeholder="Product Name">
          </div>
            </div>
            <br>

            <div class="row">
          <div class="form-group col-md-6">
            <label for="formGroupExampleInput2">Product Category</label>
            <select class="custom-select form-control" name="category" id="category">
              <option value="">Select Category</option>
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach

            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Product Sub Category</label>
            <select class="custom-select form-control" name="subcategory" id="subcategory">
              <option value="">Select Subcategory</option>

            </select>
          </div>
            </div>
            <br>

            <div class="row">
          <div class="form-group col-md-6">
            <label>Product Band</label>
            <select class="custom-select form-control" name="brand_id">
              <option value="">Select Brand</option>
              @foreach($brands as $brand)
              <option value="{{$brand->id}}">{{$brand->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Product Cost *</label>
            <input type="text" class="form-control" name="purchase_price" placeholder="Product Puuchase Price">
          </div>
          </div>
          <br>

            <div class="row">
          <div class="form-group col-md-6">
            <label for="formGroupExampleInput">Product Price *</label>
            <input type="text" class="form-control" name="sell_price" placeholder="Product Sell Price">
          </div>
          <div class="form-group col-md-6">
            <label>Product Unit</label>
            <select class="custom-select form-control" name="unit">
                @foreach($units as $unit)
                <option value="{{$unit->id}}">{{$unit->name}}</option>
                @endforeach
            </select>
          </div>

          </div>
          <br>

         

        <div class="row">

        <div class="form-group col-md-6">
          <label>Alert Quantity</label>
          <input type="text" class="form-control" name="alert_qty" placeholder="Alert Quantity">
        </div>
        <div class="form-group col-md-6">
         <label for="formGroupExampleInput">Product Image</label>
         <input type="file" class="form-control-file"name="image">
       </div>
       </div>
       <br>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Starting Quantity</label>
                <input type="number" class="form-control" name="start_inventory" placeholder="Starting Quantity">
            </div> 
            <div class="form-group col-6">
                <label>Product Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>

        </div>

<br>
        <div class="row">
            <div class="form-group col-md-4">
                <label>Discount Price</label>
                <select class="custom-select form-control" name="product_discount">

                <option value="1" >Yes</option>
                <option value="0" >No</option>       
                </select>
            </div>

            <div class="form-group col-md-4">
                <label>Add discount</label>
                <select class="custom-select form-control" name="discount">
                <option value="3">Regular Discount</option>
                <option value="4">Manual Discount</option>

                </select>
            </div>

            <div class="form-group col-md-4">
                <label>Add Manual Discount</label>
                <input type="text" class="form-control" name="manual_discount">
            </div>

        </div>
        <br>

       
     </div>

   </div>
   <div class="modal-footer">

     <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Add Product">
    </div>
  </form>
</div>
</div>
</div>
</div>


<!-- JS Start------------------------------------- -->
@section('scipts')

<script type="text/javascript">
 $(document).ready(function(){
  $(".cat_btn").click(function(){
    $("#category_area").toggle(700);
    $("#subcategory_area").hide('slow');
    $("#brands_area").hide('slow');
  });
});
 $(document).ready(function(){
  $(".subcat_btn").click(function(){
    $("#subcategory_area").toggle('slow');
    $("#brands_area").hide('slow');
    $("#category_area").hide('slow');
  });
});
 $(document).ready(function(){
  $(".brands_btn").click(function(){
    $("#brands_area").toggle('slow');
    $("#subcategory_area").hide('slow');
    $("#category_area").hide('slow');
  });
});
 $(document).ready(function(){
  $(".rightdiv").click(function(){
    $("#brands_area").hide('slow');
    $("#subcategory_area").hide('slow');
    $("#category_area").hide('slow');
  });
});
 $(document).ready(function(){

//set customer
$("#poscustomer").on('change',function(){
  var customerId=$(this).val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{route('admin.pos.setCustomer')}}",
    type:"POST",
    data:{'customerId':customerId},
        //dataType:'json',
        success:function(data){


          if(data==1){
            location.reload(true);
          }else{
            alert('Something Went wrong Please Try Again.');
          }

        },
        error:function(){
          alert("error ase");
        }
      });
     //endajax
   });  
 //customr customerReset
 $(".customerReset").click(function(){
  var ctype=1;
//ajax
$.ajax({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.customerReset')}}",
  type:"POST",
  data:{'ctype':ctype},
        //dataType:'json',
        success:function(data){


          if(data==1){
            location.reload(true);
          }else{
            alert('Something Went wrong Please Try Again.');
          }

        },
        error:function(){
          alert("error ase");
        }
      });
     //endajax
   });

 //view customer details
 $(".view_customer").click(function(){
  var customer_id=$("#poscustomer").val();

       //ajax
       $.ajax({
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{route('admin.pos.CustomerDetails')}}",
        type:"POST",
        data:{'customer_id':customer_id},
              //dataType:'json',
              success:function(data){
               // console.log(data);
               $("#customer_details").html(data);        

             },
             error:function(){
              toastr.error("Something went Wrong, Please Try again.");
            }
          });

        //end ajax
      });
//search product by name or id or code
$("#posProduct").keyup(function(){
  var key=$(this).val();
  
  //ajax
  $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.searchProduct')}}",
  type:"POST",
  data:{'key':key},

  success:function(data){

    $('.product_list').html(data);
  },
  error:function(){
    toastr.error("Something went Wrong, Please Try again.");
  }
});

  //end ajax

});
//add product by barcode scaner
$(".barcode").keypress(function(e){
  if(e.which == 13) {
    var pro_id=$(this).val();
    $(this).val('');
    addToCart(pro_id);
  }

});


//add product to cart by clicking button
$(".productItem").click(function(){
  var proId=$(this).data('pro_id');
  addToCart(proId);
});

//product add to cart 
function addToCart(proId){
  $("#posProduct").val('');
 //ajax
 $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.addToCart')}}",
  type:"POST",
  data:{'pro_id':proId},
        //dataType:'json',
        success:function(data){
        //  console.log(data);
        $("#print").html(data);
      },
      error:function(){
        toastr.error("Something went Wrong, Please Try again.");
      }
    });

  //end ajax
}
//quantiry update of cart items
$(".qty_update_input").on('change',function(){
 var rowId=$(this).data('qty');
 var qty=$(this).val();
 if($.isNumeric(qty)){
//ajax
if(qty!=0){
 $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.updateQty')}}",
  type:"POST",
  data:{'rowId':rowId,'qty':qty},
        //dataType:'json',
        success:function(data){
          console.log(data);
          $("#print").html(data);
        },
        error:function(){
         toastr.error("Something went Wrong, Please Try again.");
       }
     });
}
  //end ajax
}else{
  toastr.error("Please Enter Correct Number");
  
}


});
//update product information
$(".update-product").click(function(){
  var rowId=$(this).data('row');
  var proId=$(this).data('proid');
  $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.getProductInfo')}}",
  type:"POST",
  data:{'rowId':rowId,'proId':proId},
        //dataType:'json',
        success:function(data){
         $('.product_info').modal('show'); 
         $("#product_info").html(data);

       },
       error:function(){
         toastr.error("Something went Wrong, Please Try again.");
       }
     });
});

//tax add function
$(".tax_add_btn").click(function(){
  var tax=$("#tax_input").val();
//ajax
$.ajax({
 headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url:"{{route('admin.pos.updateTax')}}",
type:"POST",
data:{'tax':tax},
        //dataType:'json',
        success:function(data){
          $("#print").html(data);
         //data-dismiss=".tax_modal";
         $('.tax_modal').modal('hide');
       },
       error:function(){
        toastr.error("Something went Wrong, Please Try again.");
      }
    });

  //end ajax
});
//discount add function
$(".discount_add_btn").click(function(){
  var discount=$("#discount_input").val();
  var discount_type=$("#discount_type").val();
  if($.isNumeric(discount)){
    $.ajax({
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{route('admin.pos.updateDiscount')}}",
    type:"POST",
    data:{'discount':discount,'discount_type':discount_type},
        //dataType:'json',
        success:function(data){
          $("#print").html(data);
          $('.discount_modal').modal('hide');
        },
        error:function(){
          toastr.error("Something went Wrong, Please Try again.");
        }
      });
  }else{
    toastr.error("Please Enter a correct number.");

  }
//ajax


  //end ajax
});

//remove item from cart list
$(".removeItemBtn").click(function(){
 var rowId=$(this).data('cartrowrd');
 //ajax
 $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.removeItem')}}",
  type:"POST",
  data:{'rowId':rowId},
        //dataType:'json',
        success:function(data){

         $("#print").html(data);
       },
       error:function(){
        toastr.error("Something went Wrong, Please Try again.");
      }
    });

  //end ajax

});

//bill preview
$(".bill_preview").click(function(){
  var customer_id=$("#poscustomer").val();
  //ajax
  $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.billPreview')}}",
  type:"POST",
  data:{'customer_id':customer_id},
              //dataType:'json',
              success:function(data){
               // console.log(data);
               $("#bill_details").html(data);        

             },
             error:function(){
              toastr.error("Something went Wrong, Please Try again.");
            }
          });

        //end ajax
      });

//view all brands product
$(".brand_btn").click(function(){
  var brand_id=$(this).data('brand_id');
  $('.product_list').html('');
 //ajax
 $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.searchProductByBrandId')}}",
  type:"POST",
  data:{'brand_id':brand_id},
        //dataType:'json',
        success:function(data){
          console.log(data);
          $("#brands_area").hide();
          $('.product_list').html(data);
        },
        error:function(){
          toastr.error("Something went Wrong, Please Try again.");
        }
      });

  //end ajax

});
//view all categoty product
$(".category_btn").click(function(){
  var cat_id=$(this).data('cat_id');
  $('.product_list').html('');
 //ajax
 $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.searchProductByCatId')}}",
  type:"POST",
  data:{'cat_id':cat_id},
        //dataType:'json',
        success:function(data){
          console.log(data);
          $("#category_area").hide();
          $('.product_list').html(data);
        },
        error:function(){
          toastr.error("Something went Wrong, Please Try again.");
        }
      });

  //end ajax

});
//view all sub-categoty product
$(".subcategoty_btn").click(function(){
  var subcat_id=$(this).data('subcat_id');
  $('.product_list').html('');
 //ajax
 $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.searchProductBySubcatId')}}",
  type:"POST",
  data:{'subcat_id':subcat_id},
        //dataType:'json',
        success:function(data){
          console.log(data);
          $("#subcategory_area").hide();
          $('.product_list').html(data);
        },
        error:function(){
         toastr.error("Something went Wrong, Please Try again.");
       }
     });

  //end ajax

});


//payment screen
$(".payment-btn").click(function(){
  var customer_id=$("#poscustomer").val();
  $(".payment-screen").html(''); 
  //ajax
  $.ajax({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{route('admin.pos.paymentScreen')}}",
  type:"POST",
  data:{'customer_id':customer_id},
              //dataType:'json',
              success:function(data){
               $(".payment-screen").html(data); 
               $('.payment_modal').modal('show');     

             },
             error:function(){
              toastr.error("Something went Wrong, Please Try again.");
            }
          });

        //end ajax
      });


});
</script>

<script>
  $(document).ready(function(){
   $("#category").on('change',function(){
    var catId=$(this).val();
         //ajax

         $.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:"{{route('admin.subcategory.selectSubcategory')}}",
          type:"POST",
          data:{'catId':catId},
          dataType:'json',
          success:function(data){
            console.log(data);
            $('#subcategory').empty();
            $.each(data,function(index,subcatObj){

              $("#subcategory").append('<option value ="'+subcatObj.id+'">'+subcatObj.name+'</option>');
            });

          },
          error:function(){
            toastr.error("Something went Wrong, Please Try again.");
          }
        });
     //endajax
   });
 });
</script>

@endsection
@endsection
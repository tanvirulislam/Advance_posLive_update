@extends('admin.master.master')
@section('title')
Product
@endsection
@section('style')

@endsection

@section('body')
<?php use App\Http\Controllers\Admin\StockController;

?>
<br>
<br><br>
<div id="content" class="content">
	<div class="container" >
    <div class="row">
      <div class="col-md-2">
        <a style="background: darkslategrey;" href="{{route('admin.product.create')}}" type="button" class="btn btn-primary">Create product</a>
      </div>
      

      <div class="col-md-2 offset-md-8">
        <p style="background: darkslategrey;color: white; padding: 8px 0px; text-align: center; border-radius: 4px;">Product description</p>
      </div>
    </div>
    <br>
    <div class="row">
     <div class="card" >
      <div class="card-body">
       <h4 class="header-title">Product List</h4>
       <div class="data-tables datatable-primary">
        <div class="table-responsive">
          <table id="table_id" class="table table-hover table-responsive text-center form-control">
            <thead class="text-capitalize thead-light">
              <tr>
                <th width="5%">Sl</th>
                <th width="10%">Image</th>
                <th width="10%">Name</th>
                <th width="10%">code</th>
                <th width="10%">Brand</th>
                <th width="10%">Category</th>
                <th width="10%">Per Unit Cost</th>
                <th width="10%">Per Unit Price</th>
                <th width="10%">Alert Quantity</th>
                <th width="10%">Stock</th>
                <th width="10%">Total Cost</th>
                <th width="10%">Total Price</th>
                <th width="15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $counter=0;?>
              @foreach($products as $product)
              <?php $counter++;
              $stock=StockController::stock($product->id);
              ?>
              
              <tr>
              <td>{{$counter}}</td>
              <td>
                  @if(!empty($product->image))
                  <img src="{{ asset('/')}}{{$product->image}}" alt="{{$product->name}}" class="img-rounded" style="width:35px;height:35px;">
                  @else
                  <img src="{{asset('/')}}public/admin/assets/images/no.webp" alt="No-image" class="img-rounded" style="width:35px;height:35px;">

                  @endif
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->code}}</td>
                <td>{{$product->brandInfo->name}}</td>
                <td>{{$product->categoryInfo->name}}</td>
                <td>{{number_format($product->purchase_price)}}</td>
                <td>{{number_format($product->sell_price)}}</td>
                <td style="text-align: center;">{{$product->alert_qty}}</td>
                <td >
                  @if($stock<$product->alert_qty && $stock >0)
                  <p style="color:yollow;" class="badge badge-warning">{{$stock}}</p>
                  @elseif($stock <=0)
                  <p style="color:red;" class="badge badge-danger">{{$stock}}</p>
                  @else
                  <span style="color:green;" class="badge badge-success">{{$stock}}</span>
                  @endif
                </td>
                <td><p class="">{{$stock * number_format($product->purchase_price)}}</p></td>
                <td><p class="">{{$stock * number_format($product->sell_price)}}</p></td>

                <td>
                  <button class="btn btn-success productDetails"  style="font-size: 13px;cursor:pointer;" title="product Details" data-pro_id="{{$product->id}}" data-toggle="tooltip"> <i class="fa-fw fa fa-eye"></i></button>

                  <button class="btn btn-info  edit-product" data-productid="{{$product->id}}" style="font-size: 13px;cursor:pointer;" title="Edit product" data-toggle="tooltip"> <i class="fa fa-edit" ></i></button>

                  <button  type="button" class="btn btn-danger text-light" onclick="deleteTag({{ $product->id}})" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>

                  <form id="delete-form-{{ $product->id }}" action="{{ route('admin.product.delete',$product->id) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf

                  </form>
                

                </td>

                

              </tr>
                

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

<!-- Modal -->
<div class="modal fade bd-example-modal-lg productModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3 modal-data">

		</div>
	</div>
</div>

<script type="text/javascript">
	function deleteTag(id) {
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
			buttonsStyling: false,
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				event.preventDefault();
				document.getElementById('delete-form-'+id).submit();
			} else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                    ) {
				swal(
					'Cancelled',
					'Your data is safe :)',
					'error'
					)
			}
		})
	}
</script> 
@section('scipts')

<script>
	$(".productDetails").click(function(){
		var pro_id=$(this).data('pro_id');
        //ajax
        $.ajax({
        	headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	url:"{{route('admin.product.view')}}",
        	type:"POST",
        	data:{'pro_id':pro_id},
            //dataType:'json',
            success:function(data){
            	$(".modal-data").html(data);
            	$('.productModal').modal('show'); 
            },
            error:function(){
            	toastr.error("Something went Wrong, Please Try again.");
            }
        });
      //end ajax

  });  
</script>
@endsection
@endsection

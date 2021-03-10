@extends('admin.master.master')
@section('title')
Purchase
@endsection
@section('style')

@endsection

@section('body')
<br><br><br>


<div id="content" class="content">
  <div class="container" >
    <div class="row">
      <div class="col-md-2">
        <a style="background: darkslategrey;" href="{{route('admin.purchase.create')}}" type="button" class="btn btn-primary">Create product</a>
      </div>
      

      <div class="col-md-2 offset-md-8">
        <p style="background: darkslategrey;color: white; padding: 8px 0px; text-align: center; border-radius: 4px;">Purchase description</p>
      </div>
    </div>
    <div class="row">
        <div class="card" >
            <div class="card-body form-group">
                <h4 class="header-title">Purchase </h4>
                <div class="data-tables datatable-primary">
                    <div class="table-responsive">
                    <table id="table_id" class="table table-hover table-responsive text-center form-control">
                        <thead class="text-capitalize thead-light">
                        <tr>
                            <th class="font-weight-bold" scope="col">#</th>
                            <th class="font-weight-bold" scope="col">Date</th>
                            <th class="font-weight-bold" scope="col">Reference No</th>
                            <th class="font-weight-bold" scope="col">Supplier</th>
                            <th class="font-weight-bold" scope="col">Purchase Status</th>
                            <th class="font-weight-bold" scope="col">Grand Total</th>
                            <th class="font-weight-bold" scope="col">Paid</th>
                            <th class="font-weight-bold" scope="col">Discount</th>
                            <th class="font-weight-bold" scope="col">Balance</th>
                            <th class="font-weight-bold" scope="col">Payment Status</th>
                            <th class="font-weight-bold" scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter=0;?>
                        @foreach($purchaseLists as $purchase)
                        <?php $counter++;

                        ?>
                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$purchase->purchase_date}}</td>
                            <td>{{$purchase->reference}}</td>
                            <td>{{$purchase->supplier['name']}}</td>
                            <td style="text-align: center;">
                            @if($purchase->is_received==1)
                            <p class="">Received</p>
                            @else
                            <p class="">Pending</p>
                            @endif
                            </td>
                            <td style="text-align: right;">{{number_format($purchase->grand_total)}}</td>

                            <td style="text-align: right;">{{number_format($purchase->paid_amount)}}</td>
                            <td style="text-align: right;">{{number_format($purchase->discount)}}</td>
                            <td style="text-align: right;">

                            {{number_format($purchase->due)}}
                            </td>

                            <td style="text-align: center;">
                            @if($purchase->due >0)
                            <p class="">Due</p>
                            @else
                            <p class="">Paid</p>
                            @endif
                            </td>
                            <td >
                            


                            <button class="btn btn-success purchaseDetails"  style="font-size: 13px;cursor:pointer;" title="purchase Details" data-purchase_id="{{$purchase->id}}" data-toggle="tooltip"> <i class="fa-fw fa fa-eye"></i></button>

                            <button  type="button" class="btn btn-danger text-light" onclick="deleteTag({{ $purchase->id}})" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                            <form id="delete-form-{{ $purchase->id }}" action="{{ route('admin.purchase.delete',$purchase->id) }}" method="POST" style="display: none;">
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
<div class="modal fade purchase_details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3 modal-data">

    </div>
  </div>
</div>

<!-- Sweet alert -->



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

    $(document).ready(function(){

        $(".purchaseDetails").click(function(){
        var purchase_id=$(this).data('purchase_id');
        //ajax
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{route('admin.purchase.purchaseDetails')}}",
            type:"POST",
            data:{'purchase_id':purchase_id},
                //dataType:'json',
                success:function(data){
                $(".modal-data").html(data);
                $('.purchase_details').modal('show'); 
                },
                error:function(){
                toastr.error("Something went Wrong, Please Try again.");
                }
            });

        //end ajax
        });


        //end ajax
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
@endsection

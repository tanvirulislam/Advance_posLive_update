<!DOCTYPE html>
<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/') }}public/admin/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('/') }}public/admin/css/fontawesome.css">
<link rel="stylesheet" href="{{ asset('/') }}public/admin/css/style.css">
<link rel="stylesheet" href="{{ asset('/') }}public/admin/css/responsive.css">
<!-- Toastr -->
<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<!-- data table -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
                            


<style type="text/css">
    .dropdown:hover>.dropdown-menu {
  display: block;
}
.bg-color{
    background-color:green;
}
.navbar-brand{
    font-style:bold;
    font-size:30px;
}


.navbar{
    height:55px;
   
}


      
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</head>
<body>
<?php
    use App\Http\Controllers\Admin\StockController;
    $lowStock=StockController::numberOfLowStockProduct();
    ?>

<!--header-->
@include('admin.include.header')
<!--header-->

<!--side bar-->
@include('admin.include.sidebar')
<!--side bar-->

@yield('body')

@yield('scipts')

<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
        function deleteAgent(id) {
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

<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
           <script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
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
         		alert("error ase");
         	}
         });
        //endajax
        });
	});
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script type="text/javascript">

    $('#NavMenuBar').click(function () {
        SideMenuOpenClose();
    });

    $('#ContentOverlayID').click(function () {
        SideMenuOpenClose();
    });


    function SideMenuOpenClose() {
        let SideNavID= $('#SideNavID');
        let ContentOverlayID= $('#ContentOverlayID');
        let menuText=$('.menuText');
        if(SideNavID.hasClass('sideNavClose')){
            SideNavID.removeClass('sideNavClose')
            SideNavID.addClass('sideNavOpen')
            menuText.removeClass('d-none');
            ContentOverlayID.removeClass('ContentOverlayClose')
            ContentOverlayID.addClass('ContentOverlay')
        }else{
            SideNavID.removeClass('sideNavOpen')
            SideNavID.addClass('sideNavClose')
            menuText.addClass('d-none');
            ContentOverlayID.removeClass('ContentOverlay')
            ContentOverlayID.addClass('ContentOverlayClose')
        }
    }

</script>

<!-- data table -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>


</body>

</html>




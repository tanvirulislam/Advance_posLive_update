@extends('admin.master.master')
@section('title')
 Update  Advertisement
@stop
@section('body')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Update Advertisement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
            <h4 class="text-center text-primary"> Update  Advertisement</h4>
                
              </div>
              <div class="card-body">
                <form method="post" action="{{route('admin.photo.photoUpdate')}}" enctype="multipart/form-data">
                  @csrf
  <div class="form-row">
   <div class="form-group col-md-12">
      <label for="inputEmail4">Category Name </label>
      <input type="text" class="form-control" name="name" value="{{$post->name}}" placeholder="Post Title">
      <input type="hidden" class="form-control" name="id" value="{{$post->id}}" placeholder="Post Title">
    </div>

   
  <div class="form-group col-md-12">
    <label for="exampleFormControlFile1">Image</label>
    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
    <img src="{{asset('/')}}{{$post->image}}" height="50px" width="50px">
  </div>

   
   <div class="form-group col-md-12">
        
        <input type="submit" class="btn btn-primary col-12" value="submit">
      </div>
  
</form>
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
          <div class="card">
              <div class="card-header text-danger text-center"><h3><b>Some Instruction</b></h3>
              <small class="text-danger">When you try to update ,please follow the instruction for updating <b>Category Name</b></small>
              </div>
              
              <div class="card-body">
                  
                  <ul>
                      <li>For Header-section  use name:- <b class="text-danger">Header_Section</b></li>
                      <li>For Side-section  use name:- <b class="text-danger">siderbar_Section</b></li>
                      <li>For Binodon section  use name:- <b class="text-danger">binodon_Section</b></li>
                      <li>For category page section  use name:- <b class="text-danger">category_Sectionn</b></li>
                      <li>For single page section  use name:- <b class="text-danger">singlecategory_Section</b></li>
                  </ul>
              </div>
          </div>      
          
      </div
    </div>
</section>

@stop
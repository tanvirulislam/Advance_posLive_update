@extends('admin.master.master')
@section('title')
Add Advertisement
@stop
@section('body')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Advertisement</h1>
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
            <h4 class="text-center text-primary">Add Advertisement</h4>
                
              </div>
              <div class="card-body">
                <form method="post" action="{{route('admin.savephoto')}}" enctype="multipart/form-data">
                  @csrf
  <div class="form-row">
   <div class="form-group col-12">
    <label >Advertisement Category</label>
    <select class="form-control" name="name">
     
      <option value="Header_Section">Header</option>
    <option value="siderbar_Section">Side_Bar</option>
     <option value="binodon_Section">Binodon</option>
     <option value="category_Section">Category Page</option>
     <option value="singlecategory_Section">Single Category Page</option>
      
    </select>
    
  </div>
   
  <div class="form-group col-md-12">
    <label for="exampleFormControlFile1">Image</label>
    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
  </div>

    <div class="form-group col-md-12">
      <label for="inputState">Status</label>
      <select id="inputState" class="form-control" name="status">
        <option selected value="1">Active</option>
        <option value="0">InActive</option>
      </select>
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
              <small class="text-danger">For uploading photo please follow the  Dimension</b></small>
              </div>
              
              <div class="card-body">
                  
                  <ul>
                      <li>For Header-section  photo size:- <b>height*width:</b><b class="text-danger">720*90</b></li>
                      <li>For Side-section  photo size:- <b>height*width:</b><b class="text-danger">750*999</b></li>
                      <li>For Binodon section  photo size:-<b>height*width:</b> <b class="text-danger">400*100</b></li>
                      <li>For category page section  photo size:-<b>height*width:</b> <b class="text-danger">750*999</b></li>
                      <li>For single page section  photo size:- <b>height*width:</b><b class="text-danger">980*120</b></li>
                  </ul>
              </div>
          </div> 
      </div>
    </div>
</section>

@stop
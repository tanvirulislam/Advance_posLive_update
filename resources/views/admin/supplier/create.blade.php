@extends('admin.master.master')
@section('title')
Add Supplier
@endsection
@section('style')
@endsection

@section('body')
<br>
<br>
<br>
<div id="content" class="content">
    <div class="container" >
        <div class="row">
            <div class="col-md-2">
                <a style="background: darkslategrey;" href="#" type="button" class="btn btn-primary">Add supplier</a>
            </div>

            <div class="col-md-2 offset-md-8">
                <p style="background: darkslategrey;color: white; padding: 8px 0px; text-align: center; border-radius: 4px;">Supplier</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form action="{{ route('admin.supplier.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control"  name="company" placeholder="Enter a  Name">
                        </div>  
                            </div>
                          

                            <div class="col-md-4">
                              <div class="form-group">
                            <label for="name">Address</label>
                            <input type="text" class="form-control"  name="address" placeholder="Enter a  Address">
                        </div>  
                            </div>
                           
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control"  name="name" placeholder="Enter a  Name">
                        </div>  
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" class="form-control"  name="mobile" placeholder="Enter a  Phone">
                        </div>  
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control"  name="email" placeholder="Enter a  Email">
                        </div>  
                            </div>
                        </div>
                        <div class="row">
                            
                           
                            <div class="col-md-12">
                              <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" class="form-control"  name="image" placeholder="Enter a  Name">
                        </div>  
                            </div>
                        </div>
                        
                        <div class="row">
                           

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                      
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Supplier</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    
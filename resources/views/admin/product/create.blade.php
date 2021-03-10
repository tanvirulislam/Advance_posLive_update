@extends('admin.master.master')
@section('title')
Add Product
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
                <a style="background: darkslategrey;" href="#" type="button" class="btn btn-primary">Add product</a>
            </div>

            <div class="col-md-2 offset-md-8">
                <p style="background: darkslategrey;color: white; padding: 8px 0px; text-align: center; border-radius: 4px;">Product description</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.product.store')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Supplier<i class="fa-fw fa fa-plus-circle" data-toggle="modal" data-target="#supplier"></i></label>
                                        <select class="custom-select form-control" name="supplier" class="form-control">
                                            <option>Select supplier</option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->company}}({{$supplier->name}})</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Product Category <i class="fa-fw fa fa-plus-circle" data-toggle="modal" data-target="#create_category"></i></label>
                                        <select class="custom-select form-control" name="category" id="category" >
                                            <option>Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach

                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Subcategory <i class="fa-fw fa fa-plus-circle" data-toggle="modal" data-target="#create_subcategory"></i></label>
                                        <select class="custom-select form-control" name="subcategory" id="subcategory" >
                                            <option value="">Select Subcategory</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label>Product Brand <i class="fa-fw fa fa-plus-circle" data-toggle="modal" data-target="#create_brand"></i></label>
                                        <select class="custom-select form-control " name="brand">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Unit <i class="fa-fw fa fa-plus-circle" data-toggle="modal" data-target="#create_unit"></i></label>
                                        <select class="custom-select form-control" name="unit">
                                            <option value="">Select unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                             
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control"  name="name" placeholder="Enter a  Name">
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Starting Quantity</label>
                                        <input type="number" class="form-control" name="start_inventory" placeholder="Starting Quantity">
                                    </div> 
                                </div>
                            </div>
                            
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product Cost *</label>
                                        <input type="text" class="form-control" name="purchase_price" placeholder="Product Purchase Price">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="formGroupExampleInput">Product Price *</label>
                                        <input type="text" class="form-control" name="sell_price" placeholder="Product Sell Price">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">wholesell Price </label>
                                        <input type="text" class="form-control" name="whole_sell" placeholder="Product whole sell Price">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alert Quantity</label>
                                        <input type="text" class="form-control" name="alert_qty" placeholder="Alert Quantity">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Product Image</label>
                                        <input type="file" class="form-control"name="image">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Description</label>
                                        <textarea class="form-control" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Discount Price</label>
                                        <select class="custom-select form-control" name="product_discount">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>       
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Add discount</label>
                                        <select class="custom-select form-control" name="discount">
                                            <option value="3">Regular Discount</option>
                                            <option value="4">Manual Discount</option>

                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Add Manual Discount</label>
                                        <input type="text" class="form-control" name="manual_discount">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Product</button>        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--supplier model end -->

<div class="modal fade" id="supplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.supplier.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control"  name="company" placeholder="Enter a  Name">
                            </div>  
                        </div>
                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Address</label>
                                <input type="text" class="form-control"  name="address" placeholder="Enter a  Address">
                            </div>  
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control"  name="name" placeholder="Enter a  Name">
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" class="form-control"  name="mobile" placeholder="Enter a  Phone">
                            </div>  
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="" class="form-control" >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control"  name="email" placeholder="Enter a  Email">
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" class="form-control"  name="image" placeholder="Enter a  Name">
                        </div>  
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Supplier</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- model create category -->

<div class="modal fade" id="create_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control"  name="name" placeholder="Enter a  Name">
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" class="form-control"  name="image" placeholder="Enter a  Name">
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Category Description</label>
                                <textarea type="text" class="form-control"  name="description" placeholder="Enter a  Description"></textarea>
                            </div>  
                        </div>

                    </div>



                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Category</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal create subcategory-->
<div class="modal fade" id="create_subcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create subcategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.subcategory.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Category Name</label>
                                <select class="custom-select form-control" name="parentId">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Sub-Category Name</label>
                                <input type="text" class="form-control"  name="name" placeholder="Enter a  Name">
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" class="form-control"  name="image" placeholder="Enter a  Name">
                            </div>  
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Sub-Category Description</label>
                                <textarea type="text" class="form-control"  name="description" placeholder="Enter a  Description"></textarea>
                            </div>  
                        </div>

                    </div>



                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Sub-Category</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create brand-->
<div class="modal fade" id="create_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Brand Name</label>
                                <input type="text" class="form-control"  name="name" placeholder="Enter a  Name">
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control"  name="company" placeholder="Enter a  Name">
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" class="form-control"  name="image" placeholder="Enter a  Name">
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea type="text" class="form-control"  name="description" placeholder="Enter a  Description"></textarea>
                            </div>  
                        </div>

                    </div>



                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Brand</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--unit Modal -->
<div class="modal fade" id="create_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create units</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.unit.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Unit Name</label>
                                <input type="text" class="form-control"  name="name" placeholder="Enter a  Name">
                            </div>  
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Unit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- ajax subcategory Script -->



@endsection







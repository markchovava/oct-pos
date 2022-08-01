@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">ROLES</li>
    </ul>
    <h1 class="page-header">
        Add Role
    </h1>
    <form method="post" action="{{ route('admin.role.store') }}" class="row gx-4">
        @csrf
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class=" mb-3">Role Infomation</h5>
                    <div class="form-group mb-3">
                        <label class="form-label" for="product_name">Role Name:</label>
                        <input type="text" name="name"  class="form-control" id="name" placeholder="Role Name">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="product_name">Description:</label>
                        <textarea type="text" name="description" class="form-control" id="description" cols="10" rows="3" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="exampleFormControlSelect1">Select dropdown</label>
                        <select name="level" class="form-select" id="exampleFormControlSelect1">
                            <option value="1">Admin</option>
                            <option value="2">Moderator</option>
                            <option value="3">Editor</option>
                            <option value="4">Operator</option>
                        </select>
                    </div>  
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success">Add Role</button> 
                    </div> 
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- END #content -->

@endsection
@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">User</li>
    </ul>
    <h1 class="page-header">
        User List
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.sale.search') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" 
                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="Product Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.user.add') }}"></a>
            <button type="button" class="btn btn-outline-secondary">Add User</button>
        </div>
    </div>
    <div class="row gx-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
            <!-- BEGIN card -->
            <div class="card h-100">
                <div class="card-body h-100 p-1">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 3%;"scope="col">#</th>
                            <th style="width: 25%;" scope="col">Name</th>
                            <th style="width: 18%;" scope="col">Role</th>
                            <th style="width: 12%;" scope="col">Phone</th>
                            <th style="width: 12%;" scope="col">Code</th>
                            <th style="width: 15%;" scope="col">Date Joined</th>
                            <th style="width: 15%;" scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tbody>
                    </table>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
            <!-- END card -->
        </div>
    </div>

</div>
<!-- END #content -->

@endsection
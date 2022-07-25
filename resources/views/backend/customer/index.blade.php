@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">CUSTOMERS</li>
    </ul>
    <h1 class="page-header">
        Customer List
    </h1>
    <div class="row mb-4">
        <div class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" placeholder="Product Name">
                <span class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </span>
            </div>
        </div>
        <div class="col-sm-7 text-end">
            <button type="button" class="btn btn-outline-secondary">Add Customer</button>
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
                            <th style="width: 5%;"scope="col">#</th>
                            <th style="width: 21%;" scope="col">Name</th>
                            <th style="width: 18%;" scope="col">Customer Id</th>
                            <th style="width: 18%;" scope="col">Phone Number</th>
                            <th style="width: 18%;" scope="col">Last Update</th>
                            <th style="width: 18%;" scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <i class="fas fa-lg fa-fw me-2 fa-times"></i>
                                </th>
                                <td>Mark.</td>
                                <td>123454321</td>
                                <td>123 234 345</td>
                                <td>2022-07-07 </td>
                                <td>
                                    <a href="#" class="icon__success">
                                        <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                    </a>
                                    <a href="#" class="icon__info">
                                        <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                    </a>
                                    <a href="#" class="icon__danger">
                                        <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
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

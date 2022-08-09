@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        <li class="breadcrumb-item active">TAX</li>
    </ul>
    <h1 class="page-header">
        Tax
    </h1>
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
        <div class="card h-100 p-4">
            <form method="post" action="{{ route('admin.tax.update') }}" class="container">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Tax Name:</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($tax->name) ? $tax->name : '' }}"
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="percent" class="form-label">Tax Percent:</label>
                            <input type="number" name="percent" class="form-control"
                                value="{{ isset($tax->percent) ? $tax->percent : '' }}"
                            />
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-outline-success">Save Tax</button>
                </div>
            </form>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
   

</div>
<!-- END #content -->

@endsection
@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">STOCK</li>
    </ul>
    <h1 class="page-header">
        {{ $product->name }}
    </h1>
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
        <div class="card h-100 p-4">
            <form method="post" action="{{ route('admin.stock.update', $product->id) }}" class="container">
                @csrf
                <div class="form-group mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control"
                        value="{{ isset($product->stock->quantity) ? $product->stock->quantity : '' }}"
                    />
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-outline-success">Update Quantity</button>
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
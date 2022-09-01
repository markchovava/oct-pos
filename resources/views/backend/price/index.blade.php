@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">PRICE</li>
    </ul>
    <h1 class="page-header">
        Product Prices
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.price.search') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" 
                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="Product Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.product.add') }}">
                <button type="button" class="btn btn-outline-secondary">Add Product</button>
            </a>
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
                            <th style="width: 10%;" scope="col"># </th>
                            <th style="width: 30%;" scope="col">Name </th>
                            <th style="width: 20%;" scope="col">USD Unit Price </th>
                            <th style="width: 20%;" scope="col">ZWL Unit Price </th>
                            <th style="width: 20%;" scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @if( isset($products) )
                                @php($i = 1)
                                @foreach( $products as $price )
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $price->name }}</td>
                                    <td>
                                        @php( $usd = intval($price->price->usd) / 100 )
                                        ${{ number_format($usd, 2, '.', '') }}   
                                    </td>
                                    <td>
                                        @php( $zwl = intval($price->price->zwl) / 100 )
                                        ${{ number_format($zwl, 2, '.', '') }}   
                                    </td>
                                    <td>
                                        @can('create', $price) 
                                        <a href="{{ route('admin.price.edit', $price->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                            @if( isset($results) )
                                @php($i = 1)
                                @foreach( $results as $result )
                                <tr>
                                    <td> {{ $i++ }}</td>  
                                    <td> {{ $result->name }} </td>
                                    <td> {{ $result->price->usd }} </td>      
                                    <td> {{ $result->price->zwl }} </td>           
                                    <td>
                                        @can('create', $result)
                                        <a href="{{ route('admin.price.edit', $result->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if( isset($products) )
                        <div class="my-2">
                            {{ $products->links() }}
                        </div>
                        @elseif( isset($results) )
                        <div class="my-2">
                            {{ $result->links() }}
                        </div>
                    @endif
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
@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">SALES</li>
    </ul>
    <h1 class="page-header">
        Product Sold
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
            <a href="{{ route('admin.pos') }}">
                <button type="button" class="btn btn-outline-secondary">Add Sales</button>
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
                                <th style="width: 30%;" scope="col">Name </th>
                                <th style="width: 20%;" scope="col">Quantity </th>
                                <th style="width: 15%;" scope="col">Currency </th>
                                <th style="width: 15%;" scope="col">Total </th>
                                <th style="width: 20%;" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( isset($sales) )
                                @foreach( $sales as $sale )
                                    <tr>
                                        <td> {{ $sale->product_name }} </td>
                                        <td> {{ $sale->quantity }} </td>      
                                        <td> {{ $sale->currency }} </td>      
                                        <td> 
                                        @php
                                                $sale = (int)$sale->product_total / 100
                                        @endphp
                                            ${{ number_format((float)$sale,2,'.','') }}
                                        </td>      
                                        <td>
                                            <a href="#" class="icon__info">
                                                <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if( isset($results) )
                                @foreach( $results as $sale )
                                    <tr>
                                        <td> {{ $sale->product_name }} </td>
                                        <td> {{ $sale->quantity }} </td>      
                                        <td> {{ $sale->currency }} </td>      
                                        <td> 
                                        @php
                                                $sale = (int)$sale->product_total / 100
                                        @endphp
                                            ${{ number_format((float)$sale,2,'.','') }}
                                        </td>      
                                        <td>
                                            <a href="#" class="icon__info">
                                                <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if( isset($sales) )
                        <div class="my-2">
                            {{ $sales->links() }}
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
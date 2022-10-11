@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.sale.daily') }}">DAILY SALES</a></li>
        <li class="breadcrumb-item active">SALES LIST</li>
    </ul>
    <h1 class="page-header">
        Product Sold
    </h1>
    <div class="row mb-4">
        <div class="col-sm-5">
            <div class="h6 my-auto">
                Date: <span class="text-success">{{ $date }}</span>
            </div>
        </div>
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
                                <th style="width: 10%;" scope="col"># </th>
                                <th style="width: 30%;" scope="col">Product Name </th>
                                <th style="width: 20%;" scope="col">Quantity </th>
                                <th style="width: 20%;" scope="col">Currency </th>
                                <th style="width: 20%;" scope="col">Total </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php( $i=1 )
                            @foreach( $sales as $sale)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $sale->product_name }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ $sale->currency }}</td>
                                    <td>
                                        @php( $sale = (int)$sale->product_total / 100 )
                                        ${{ number_format((float)$sale, 2, '.', '') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="my-2">
                        {{ $sales->links() }}
                    </div>
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
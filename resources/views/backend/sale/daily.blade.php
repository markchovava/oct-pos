@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">SALES</li>
    </ul>
    <h1 class="page-header mb-4">
        Daily Sales
    </h1>
    <div class="row gx-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
            <!-- BEGIN card -->
            <div class="card h-100">
                <div class="card-body h-100 p-1">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 5%;" scope="col"># </th>
                                <th style="width: 20%;" scope="col">Date </th>
                                <th style="width: 15%;" scope="col">Quantity </th>
                                <th style="width: 20%;" scope="col">Currency </th>
                                <th style="width: 20%;" scope="col">Total </th>
                                <th style="width: 20%;" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php( $i=1 )
                            @foreach( $sales as $sale)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>@php( $date = $sale->date )
                                        {{ \Carbon\Carbon::parse($date)->format('j M Y') }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ $sale->currency }}</td>
                                    <td>
                                        @php( $sale = (int)$sale->product_total / 100 )
                                        ${{ number_format((float)$sale, 2, '.', '') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sale.daily.list', $date) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>   
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
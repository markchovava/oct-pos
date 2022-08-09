@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.operation.list') }}">OPERATION</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.order.view', $order->operation_id) }}">ORDERS</a></li>
        <li class="breadcrumb-item active">ORDERS ITEMS</li>
    </ul>
    <h1 class="page-header">
       Order Items List
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.item.searchlist') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" 
                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="Order Number">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.pos') }}">
                <button type="button" class="btn btn-outline-secondary">Add Items</button>
            </a>
        </div>
    </div>
    <div class="row gx-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
            <!-- BEGIN card -->
            <div class="card h-100">
                <div class="card-body h-100 p-1">
                    @if( isset($items) )
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"scope="col">#</th>
                                    <th style="width: 20%;"scope="col">Product Name</th>
                                    <th style="width: 15%;" scope="col">Barcode</th>
                                    <th style="width: 15%;" scope="col">Quantity</th>
                                    <th style="width: 10%;" scope="col">Currency</th>
                                    <th style="width: 15%;" scope="col">Total</th>
                                    <th style="width: 15%;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php( $i = 1 )
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->product_barcode }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->currency }}</td>
                                        <td>
                                            @php( $total = $item->product_total / 100 )
                                            ${{ number_format($total, 2, '.', '') }}
                                        </td>
                                        <td>
                                            <a href="#" class="icon__info">
                                                <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.item.delete', $item->id) }}" class="icon__danger">
                                                <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @elseif( isset($results) )
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;"scope="col">#</th>
                                    <th style="width: 20%;"scope="col">Product Name</th>
                                    <th style="width: 15%;" scope="col">Barcode</th>
                                    <th style="width: 15%;" scope="col">Quantity</th>
                                    <th style="width: 10%;" scope="col">Currency</th>
                                    <th style="width: 15%;" scope="col">Total</th>
                                    <th style="width: 15%;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php( $i = 1 )
                                @foreach($results as $item)
                                    <tr>
                                        <td>{{ $i = 1 }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->product_barcode }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->currency }}</td>
                                        <td>
                                            @php( $total = $item->product_total / 100 )
                                            ${{ number_format($total, 2, '.', '') }}
                                        </td>
                                        <td>
                                            <a href="#" class="icon__info">
                                                <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.item.delete', $item->id) }}" class="icon__danger">
                                                <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center h3 text-warning"> No Operations available yet.</div>
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
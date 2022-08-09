@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.operation.list') }}">OPERATIONS</a></li>
        <li class="breadcrumb-item active">ORDERS</li>
    </ul>
    <h1 class="page-header">
       All Orders
</h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.order.searchview') }}" class="col-sm-5">
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
                <button type="button" class="btn btn-outline-secondary">Add Orders</button>
            </a>
        </div>
    </div>
    <div class="row gx-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
            <!-- BEGIN card -->
            <div class="card h-100">
                <div class="card-body h-100 p-1">
                    @if( isset($orders) )
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 15%;"scope="col">Created At</th>
                                    <th style="width: 15%;"scope="col">Order No.</th>
                                    <th style="width: 5%;" scope="col">Currency</th>
                                    <th style="width: 10%;" scope="col">Tax</th>
                                    <th style="width: 10%;" scope="col">Discount</th>
                                    <th style="width: 15%;" scope="col">Subtotal</th>
                                    <th style="width: 15%;" scope="col">Total</th>
                                    <th style="width: 15%;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->transaction_id }}</td>
                                    <td>{{ $order->currency }}</td>
                                    <td>
                                        @php($tax = $order->tax / 100 )
                                        ${{ number_format($tax, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php($discount = $order->discount / 100 )
                                        ${{ number_format($discount, 2, '.', '') }}
                                    </td>
                                     <td>
                                        @php($subtotal = $order->subtotal / 100 )
                                        ${{ number_format($subtotal, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php($grandtotal = $order->grandtotal / 100 )
                                        ${{ number_format($grandtotal, 2, '.', '') }}
                                     </td>
                                    <td>
                                        @can('view-any', $order)
                                        <a href="{{ route('admin.item.list', $order->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $order)
                                        <a href="{{ route('admin.order.delete', $order->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @elseif( isset($results) )
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 15%;"scope="col">Created At</th>
                                    <th style="width: 15%;"scope="col">Order No.</th>
                                    <th style="width: 5%;" scope="col">Currency</th>
                                    <th style="width: 10%;" scope="col">Tax</th>
                                    <th style="width: 10%;" scope="col">Discount</th>
                                    <th style="width: 15%;" scope="col">Subtotal</th>
                                    <th style="width: 15%;" scope="col">Total</th>
                                    <th style="width: 15%;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $order)
                                <tr>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->transaction_id }}</td>
                                    <td>{{ $order->currency }}</td>
                                    <td>
                                        @php($tax = $order->tax / 100 )
                                        ${{ number_format($tax, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php($discount = $order->discount / 100 )
                                        ${{ number_format($discount, 2, '.', '') }}
                                    </td>
                                     <td>
                                        @php($subtotal = $order->subtotal / 100 )
                                        ${{ number_format($subtotal, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php($grandtotal = $order->grandtotal / 100 )
                                        ${{ number_format($grandtotal, 2, '.', '') }}
                                     </td>
                                    <td>
                                        <a href="{{ route('admin.item.list', $order->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.order.delete', $order->id) }}" class="icon__danger">
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
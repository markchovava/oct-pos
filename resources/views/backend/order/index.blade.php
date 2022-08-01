@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">ORDERS</li>
    </ul>
    <h1 class="page-header">
        Order List
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
            <a href="{{ route('admin.product.add') }}"></a>
            <button type="button" class="btn btn-outline-secondary">Add Order</button>
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
                            <th style="width: 12%;" scope="col">Transaction ID </th>
                            <th style="width: 18%;" scope="col">Operator </th>
                            <th style="width: 8%;" scope="col">Quantity</th>
                            <th style="width: 12%;" scope="col">Currency  </th>
                            <th style="width: 12%;" scope="col">Total </th>
                            <th style="width: 15%;" scope="col">Created At </th>
                            <th style="width: 15%;" scope="col">Action </th>
                        </tr>
                    </thead>
                        <tbody>
                            @if( isset( $orders ) )
                                @foreach( $orders as $order )
                                <tr>
                                    <th scope="row">
                                       {{ $order->transaction_id }}
                                    </th>
                                    <td>{{ $order->operation->user->name }}</td>
                                    <td>{{ $order->order_items->sum('quantity') }}</td>
                                    <td>{{ $order->currency }}</td>
                                    <td>
                                        @php
                                            $subtotal = intval($order->subtotal) / 100;
                                        @endphp
                                        ${{ number_format($subtotal, 2, '.', '') }}
                                    </td>
                                    <td>
                                        ${{ $order->created_at }}
                                    </td>
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
                                @endforeach
                            @endif
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
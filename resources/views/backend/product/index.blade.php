@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">PRODUCTS</li>
    </ul>
    <h1 class="page-header">
        Product List
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
            <a href="{{ route('admin.product.add') }}">
                <button type="button" class="btn btn-outline-secondary">
                    Add Product
                </button>
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
                            <th style="width: 3%;"scope="col">#</th>
                            <th style="width: 25%;" scope="col">Name</th>
                            <th style="width: 18%;" scope="col">Barcode</th>
                            <th style="width: 12%;" scope="col">Unit Price USD</th>
                            <th style="width: 12%;" scope="col">Unit Price ZWL</th>
                            <th style="width: 15%;" scope="col">Date Added</th>
                            <th style="width: 15%;" scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @php
                            ( $i = 1 )
                            @endphp
                            @if( isset($products) )
                                @foreach( $products as $product )
                                <tr>
                                    <th scope="row">
                                        {{ $i++ }}
                                    </th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>
                                        @php
                                            $usd = intval($product->price->usd) / 100;
                                        @endphp
                                        ${{ number_format($usd, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php
                                            $zwl = intval($product->price->zwl) / 100;
                                        @endphp
                                        ${{ number_format($zwl, 2, '.', '') }}
                                    </td>
                                    <td>{{ $product->created_at->diffForHumans() }} </td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.product.view', $product->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.product.delete', $product->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            @if( isset($results) )
                                @foreach( $results as $product )
                                <tr>
                                    <th scope="row">
                                        {{ $i++ }}
                                    </th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>
                                        @php
                                            $usd = intval($product->price->usd) / 100;
                                        @endphp
                                        ${{ number_format($usd, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php
                                            $zwl = intval($product->price->zwl) / 100;
                                        @endphp
                                        ${{ number_format($zwl, 2, '.', '') }}
                                    </td>
                                    <td>{{ $product->created_at }} </td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.product.view', $product->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.product.delete', $product->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
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
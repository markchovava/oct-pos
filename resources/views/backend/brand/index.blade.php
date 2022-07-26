@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">BRANDS</li>
    </ul>
    <h1 class="page-header">
        Brand list
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.brand.search') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" placeholder="Brand Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.brand.add') }}">
                <button type="button" class="btn btn-outline-secondary">Add Brand</button>
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
                            <th style="width: 7%;" scope="col">#</th>
                            <th style="width: 30%;" scope="col">Image</th>
                            <th style="width: 50%;" scope="col">Name</th>
                            <th style="width: 20%;" scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @if( isset($brands) )
                            @php($i = 1)
                                @foreach( $brands as $brand )
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="img__icon-40">
                                            <img src="{{ (!empty($brand->image)) ? url('storage/images/brands/' . $brand->image) : url('storage/images/brands/no_image.jpg') }}" 
                                            style="width:100%; height:100%; object-fit:cover;" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $brand->name }}</td>      
                                    <td>
                                        <a href="{{ route('admin.brand.edit', $brand->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.brand.delete', $brand->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                            @if( isset($results) )
                                @php($i = 1)
                                @foreach($results as $result )
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="img__icon-40">
                                            <img src="{{ (!empty($result->image)) ? url('storage/images/brands/' . $result->image) : url('storage/images/brands/no_image.jpg') }}" 
                                            style="width:100%; height:100%; object-fit:cover;" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $result->name }}</td>      
                                    <td>
                                        <a href="{{ route('admin.brand.edit', $result->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.brand.delete', $result->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if( isset($brands) )
                    <div class="my-2">
                        {{ $brands->links() }}
                    </div>
                    @elseif( isset($results) )
                    <div class="my-2">
                        {{ $results->links() }}
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
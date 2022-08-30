@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">CATEGORIES</li>
    </ul>
    <h1 class="page-header">
        Category list
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.category.search') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" placeholder="Category Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.category.add') }}">
                <button type="button" class="btn btn-outline-secondary">Add Category</button>
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
                            <th style="width: 30%;" scope="col">Name</th>
                            <th style="width: 43%;" scope="col">Description</th>
                            <th style="width: 20%;" scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @if( isset($categories) )
                                @php($i = 1)
                                @foreach( $categories as $category )
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>      
                                    <td>
                                        <a href="{{ route('admin.category.edit', $category->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.category.delete', $category->id) }}" class="icon__danger">
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
                                    <td>{{ $result->name }}</td>
                                    <td>{{ $result->description }}</td>      
                                    <td>
                                        <a href="{{ route('admin.category.edit', $result->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.category.delete', $result->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if( isset($categories) )
                    <div class="my-2">
                        {{ $categories->links() }}
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
@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">INFO</li>
    </ul>
    <h1 class="page-header">
        Info List
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.info.search') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" 
                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="Company Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.info.add') }}">
                <button type="button" class="btn btn-outline-secondary">Add Info</button>
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
                            <th style="width: 5%;"scope="col">#</th>
                            <th style="width: 20%;" scope="col">Name</th>
                            <th style="width: 20%;" scope="col">Phone</th>
                            <th style="width: 40%;" scope="col">Address</th>
                            <th style="width: 15%;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( isset($infos) )
                            @php( $i = 1 )
                            @foreach($infos as $info)   
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->phone }}</td>
                                    <td>{{ $info->address }}</td>
                                    <td>
                                        <a href="{{ route('admin.info.edit', $info->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.info.view', $info->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.info.delete', $info->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        @if( isset($results) )
                            @php( $i = 1 )
                            @foreach($results as $info)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $info->name}}</td>
                                    <td>{{ $info->role->name }}</td>
                                    <td>{{ $info->phone}}</td>
                                    <td>{{ $info->address }}</td>
                                    <td>
                                        @can('create', $user)
                                        <a href="{{ route('admin.info.edit', $info->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        @endcan
                                        @can('view', $user)
                                        <a href="{{ route('admin.info.view', $info->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $user)
                                        <a href="{{ route('admin.info.delete', $info->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
                @if( isset($infos) )
                    <div class="my-2">
                        {{ $infos->links() }}
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
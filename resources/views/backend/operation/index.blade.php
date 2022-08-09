@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        <li class="breadcrumb-item active">OPERATORS</li>
    </ul>
    <h1 class="page-header">
       Operators List
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.operation.search') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" 
                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="Operator Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.operation.add') }}">
                <button type="button" class="btn btn-outline-secondary">Add Operator</button>
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
                            <th style="width: 20%;" scope="col">Name</th>
                            <th style="width: 15%;" scope="col">Phone Number</th>
                            <th style="width: 12%;" scope="col">Email</th>
                            <th style="width: 10%;" scope="col">Role</th>
                            <th style="width: 10%;" scope="col">Code</th>
                            <th style="width: 15%;" scope="col">Date Joined</th>
                            <th style="width: 15%;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( isset($operators) )
                            @php( $i = 1 )
                            @foreach($operators as $operator)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $operator->name }}</td>
                                    <td>{{ $operator->phone_number }}</td>
                                    <td>{{ $operator->email }}</td>
                                    <td>{{ isset($operator->role) ? $operator->role->name : '' }}</td>
                                    <td>
                                        <span class="text-success">
                                            {{ isset($operator->code) ? $operator->code : 'Encrypted'}}
                                        </span>
                                    </td>
                                    <td>{{ $operator->created_at }}</td>
                                    <td>
                                        @can('create', $operator)
                                        <a href="{{ route('admin.operation.edit', $operator->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        @endcan
                                        @can('view', $operator)
                                        <a href="{{ route('admin.operation.view', $operator->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $operator)
                                        <a href="{{ route('admin.operation.delete', $operator->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        @if( isset($results) )
                            @php( $i = 1 )
                            @foreach($results as $operator)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $operator->name }}</td>
                                    <td>{{ $operator->phone_number }}</td>
                                    <td>{{ $operator->email }}</td>
                                    <td>{{ isset($operator->role) ? $operator->role->name : '' }}</td>
                                    <td>{{ $operator->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.operation.view', $operator->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.operation.delete', $operator->id) }}" class="icon__danger">
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
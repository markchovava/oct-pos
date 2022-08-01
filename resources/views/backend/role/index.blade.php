@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">ROLES</li>
    </ul>
    <h1 class="page-header">
        Roles List
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.role.search') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" placeholder="Role Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.role.add') }}">
                <button type="button" class="btn btn-outline-secondary">Add Role</button>
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
                            <th style="width: 25%;" scope="col">Name</th>
                            <th style="width: 45%;" scope="col">Description</th>
                            <th style="width: 15%;" scope="col">Level</th>
                            <th style="width: 15%;" scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @if( isset($roles) )
                                @foreach( $roles as $role )
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>      
                                    <td>
                                        @if($role->level == 1)
                                        Admin
                                        @elseif($role->level == 2)
                                        Moderator
                                        @elseif($role->level == 3)
                                        Editor
                                        @elseif($role->level == 4)
                                        Operator
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.role.edit', $role->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.role.delete', $role->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                            @if( isset($results) )
                                @foreach($results as $result )
                                <tr>
                                    <td>{{ $result->name }}</td>
                                    <td>{{ $result->description }}</td>      
                                    <td>
                                        @if($result->level == 1)
                                        Admin
                                        @elseif($result->level == 2)
                                        Moderator
                                        @elseif($result->level == 3)
                                        Editor
                                        @elseif($result->level == 4)
                                        Operator
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.role.edit', $result->id) }}" class="icon__success">
                                            <i class="fas fa-lg fa-fw me-2 fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.role.delete', $result->id) }}" class="icon__danger">
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
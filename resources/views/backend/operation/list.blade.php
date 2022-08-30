@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        <li class="breadcrumb-item active">OPERATION</li>
    </ul>
    <h1 class="page-header">
       Operations List
    </h1>
    <div class="row mb-4">
        <form method="get" action="{{ route('admin.operation.searchlist') }}" class="col-sm-5">
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control" name="search" 
                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="Operator Name">
                <button type="submit" class="input-group-text btn btn-outline-secondary">
                    <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-7 text-end">
            <a href="{{ route('admin.pos') }}">
                <button type="button" class="btn btn-outline-secondary">Add Operation</button>
            </a>
        </div>
    </div>
    <div class="row gx-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
            <!-- BEGIN card -->
            <div class="card h-100">
                <div class="card-body h-100 p-1">
                    @if( isset($operations) )
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 20%;"scope="col">Name</th>
                                    <th style="width: 15%;"scope="col">Start Time</th>
                                    <th style="width: 15%;" scope="col">End Time</th>
                                    <th style="width: 5%;" scope="col">Status</th>
                                    <th style="width: 15%;" scope="col">USD Total</th>
                                    <th style="width: 15%;" scope="col">ZWL Total</th>
                                    <th style="width: 15%;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operations as $operation)
                                <tr>
                                    <td>{{ $operation->user->name }}</td>
                                    <td>{{ $operation->start_time }}</td>
                                    <td>{{ $operation->end_time }}</td>
                                    <td>
                                        @if( $operation->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($operation->status == 0)
                                            <span class="badge badge-danger">Not active</span>
                                        @else
                                            <span class="badge badge-info">No Operation</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php($usd = (int)$operation->usd_total / 100)
                                        ${{ number_format($usd, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php($zwl = (int)$operation->zwl_total / 100)
                                        ${{ number_format($zwl, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @can('view', $operation)
                                        <a href="{{ route('admin.order.view', $operation->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $operation)
                                        <a href="{{ route('admin.operation.deletelist', $operation->id) }}" class="icon__danger">
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
                                    <th style="width: 20%;"scope="col">Name</th>
                                    <th style="width: 15%;"scope="col">Start Time</th>
                                    <th style="width: 15%;" scope="col">End Time</th>
                                    <th style="width: 5%;" scope="col">Status</th>
                                    <th style="width: 15%;" scope="col">USD Total</th>
                                    <th style="width: 15%;" scope="col">ZWL Total</th>
                                    <th style="width: 15%;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $operation)
                                <tr>
                                    <td>{{ $operation->user->name }}</td>
                                    <td>{{ $operation->start_time }}</td>
                                    <td>{{ $operation->end_time }}</td>
                                    <td>
                                        @if( $operation->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($operation->status == 0)
                                            <span class="badge badge-danger">Not active</span>
                                        @else
                                            <span class="badge badge-info">No Operation</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php($usd = (int)$operation->usd_total / 100)
                                        ${{ number_format($usd, 2, '.', '') }}
                                    </td>
                                    <td>
                                        @php($zwl = (int)$operation->zwl_total / 100)
                                        ${{ number_format($zwl, 2, '.', '') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.order.view', $operation->id) }}" class="icon__info">
                                            <i class="fas fa-lg fa-fw me-2 fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.order.delete', $operation->id) }}" class="icon__danger">
                                            <i class="fas fa-lg fa-fw me-2 fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if( isset($operation) )
                            <div class="my-2">
                                {{ $operation->links() }}
                            </div>
                            @elseif( isset($result) )
                            <div class="my-2">
                                {{ $result->links() }}
                            </div>
                        @endif
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
@extends('backend._layouts.master')

@section('backend.master')



<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">OPERATOR</li>
    </ul>
    <h1 class="page-header">
        Operator Info
    </h1>
    <div class="card">
        <div class="card-body p-0">
            <!-- BEGIN profile -->
            <div class="profile">
                <!-- BEGIN profile-container -->
                <div class="profile-container">
                    <!-- BEGIN profile-sidebar -->
                    <div class="profile-sidebar">
                        <div class="desktop-sticky-top img__area">
                            <div class="nav-field mb-3">Operator Thumbnail</div>
                            <div class="mb-3 img__aspect5by4" 
                            style="border-radius:5px; border:1px solid rgba(255,255,255,.3)">
                                <img src="{{ (!empty($operator->image)) ? url('storage/images/users/' . $operator->image) : url('storage/images/users/no_image.jpg') }}"
                                style="width:100%; height:100%; object-fit:cover;" />
                            </div>
                            <!-- profile info -->
                            <hr class="mt-4 mb-4" />
                    
                        </div>
                    </div>
                    <!-- END profile-sidebar -->
            
                    <!-- BEGIN profile-content -->
                    <div class="profile-content">
                        <ul class="profile-tab nav nav-tabs nav-tabs-v2">
                            <li class="nav-item">
                                <a href="#details" class="nav-link active" data-bs-toggle="tab">
                                    <div class="nav-field">Personal Details</div>
                                    <!-- <div class="nav-value">382</div> -->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#operations" class="nav-link" data-bs-toggle="tab">
                                    <div class="nav-field">Operations</div>
                                    <!-- <div class="nav-value">382</div> -->
                                </a>
                            </li>
                        </ul>
                        <div class="profile-content-container">
                            <div class="row gx-4">
                                <div class="col-xl-12">
                                    <div class="tab-content p-0">
                                        <!-- BEGIN tab-pane -->
                                        <div class="tab-pane fade show active" id="details">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class=" mb-3">Basic Information</h5>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Full Name:</div>
                                                        <div class="col-md-8"> {{ $operator->first_name . " " . $operator->last_name }}</div>
                                                    </div>
                                                     <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Address:</div>
                                                        <div class="col-md-8">{{ $operator->address }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Phone Number:</div>
                                                        <div class="col-md-8">{{ $operator->phone_number }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Email:</div>
                                                        <div class="col-md-8">{{ $operator->email }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Date of Birth:</div>
                                                        <div class="col-md-8"> {{ $operator->date_of_birth }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Gender:</div>
                                                        <div class="col-md-8">{{ $operator->gender }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Role:</div>
                                                        <div class="col-md-8">{{ isset($operator->role->name) ? $operator->role->name : '' }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Company / Branch:</div>
                                                        <div class="col-md-8">{{ isset($info->name) ? $info->name : '' }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- END tab-pane -->
                                        <!-- BEGIN tab-pane -->
                                        <div class="tab-pane fade" id="operations">
                                            <div class="card mb-3">
                                                <div class="card-body h-100 p-1">
                                                    @if( isset($operations) )
                                                        <table class="table table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 25%;"scope="col">Start Time</th>
                                                                    <th style="width: 25%;" scope="col">End Time</th>
                                                                    <th style="width: 10%;" scope="col">Status</th>
                                                                    <th style="width: 20%;" scope="col">USD Total</th>
                                                                    <th style="width: 20%;" scope="col">ZWL Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($operations as $operation)
                                                                <tr>
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
                                            
                                        </div>
                                        <!-- END tab-pane -->
                                        <!-- BEGIN -->
                                        <div class="mt-4 mb-3">
                                            <div class="row">
                                                <div class="col-sm-12 text-end">
                                                    <a href="{{ route('admin.operation.index') }}">
                                                        <button type="button" class="btn btn-outline-success">Operators List</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END -->                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END profile-content -->
                </div>
                <!-- END profile-container -->
            </div>
            <!-- END profile -->
        </div>
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
</div>
<!-- END #content -->




@endsection
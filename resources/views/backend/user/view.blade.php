@extends('backend._layouts.master')

@section('backend.master')



<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">USER</li>
    </ul>
    <h1 class="page-header">
        User Info
    </h1>
    <div class="card">
        <div class="card-body p-0">
            <form method="post" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            <!-- BEGIN profile -->
            <div class="profile">
                <!-- BEGIN profile-container -->
                <div class="profile-container">
                    <!-- BEGIN profile-sidebar -->
                    <div class="profile-sidebar">
                        <div class="desktop-sticky-top img__area">
                            <div class="nav-field mb-3">User Thumbnail</div>
                            <div class="mb-3 img__aspect5by4" 
                            style="border-radius:5px; border:1px solid rgba(255,255,255,.3)">
                                <img src="{{ (!empty($user->image)) ? url('storage/images/users/' . $user->image) : url('storage/images/users/no_image.jpg') }}"
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
                                                        <div class="col-md-8"> {{ $user->first_name . " " . $user->last_name }}</div>
                                                    </div>
                                                     <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Address:</div>
                                                        <div class="col-md-8">{{ $user->address }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Phone Number:</div>
                                                        <div class="col-md-8">{{ $user->phone_number }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Email:</div>
                                                        <div class="col-md-8">{{ $user->email }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Date of Birth:</div>
                                                        <div class="col-md-8"> {{ $user->date_of_birth }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Gender:</div>
                                                        <div class="col-md-8">{{ $user->gender }}</div>
                                                    </div>
                                                    <hr class="mt-3 mb-3" />
                                                    <div class="row">
                                                        <div class="col-md-4">Role:</div>
                                                        <div class="col-md-8">{{ isset($user->role->name) ? $user->role->name : '' }}</div>
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
                                        <!-- BEGIN -->
                                        <div class="mt-4 mb-3">
                                            <div class="row">
                                                <div class="col-sm-12 text-end">
                                                    <a href="{{ route('admin.user.index') }}">
                                                        <button type="button" class="btn btn-outline-success">User List</button>
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
            </form>
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
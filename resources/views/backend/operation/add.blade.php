@extends('backend._layouts.master')

@section('backend.master')



<!-- BEGIN #content -->
<div id="content" class="app-content">
    <div class="card">
        <div class="card-body p-0">
            <form method="post" action="{{ route('admin.operation.store') }}" enctype="multipart/form-data">
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
                                <img style="width:100%; height:100%; object-fit:cover;" />
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" name="image" class="img__thumbnail form-control">
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
                                    <div class="nav-field">Operator Details</div>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="first_name">First Name:</label>
                                                                <input type="text" name="first_name"  class="form-control" id="first_name" 
                                                                placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="last_name">Last Name:</label>
                                                                <input type="text" name="last_name"  class="form-control" id="last_name" 
                                                                placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="gender">Gender:</label>
                                                                <select name="gender" class="form-select" id="Gender">
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="date_of_birth">Date of Birth:</label>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <input type="number" name="day" min="1" class="form-control" id="date_of_birth"
                                                                    placeholder="DD">
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <select name="month" class="form-select bg-white bg-opacity-5">
                                                                        <option value="January">January </option>
                                                                        <option value="February">February </option>
                                                                        <option value="March">March </option>
                                                                        <option value="April">April </option>
                                                                        <option value="May">May </option>
                                                                        <option value="June">June </option>
                                                                        <option value="July">July </option>
                                                                        <option value="August">August </option>
                                                                        <option value="September">September </option>
                                                                        <option value="October">October </option>
                                                                        <option value="November">November </option>
                                                                        <option value="December">December </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="number" name="year" min="1" class="form-control" id="date_of_birth"
                                                                    placeholder="YYYY">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="address">Address:</label>
                                                                <input type="text" name="address" class="form-control" id="address" 
                                                                placeholder="Address">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="phone_number">Phone Number:</label>
                                                                <input type="text" name="phone_number" class="form-control" id="phone_number" 
                                                                placeholder="Phone Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="email">Email:</label>
                                                                <input type="email" name="email" class="form-control" id="email" 
                                                                placeholder="Email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($roles))
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="role">Role</label>
                                                                <select name="role_id" class="form-select" id="role">
                                                                    @foreach($roles as $role)
                                                                    <option value="{{ $role->level }}">{{ $role->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> 
                                                        </div>
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
                                            
                                        </div>
                                        <!-- END tab-pane -->
                                        <!-- BEGIN -->
                                        <div class="mt-4 mb-3">
                                            <div class="row">
                                                <div class="col-sm-12 text-end">
                                                    <button type="submit" class="btn btn-outline-success">Add User</button>
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
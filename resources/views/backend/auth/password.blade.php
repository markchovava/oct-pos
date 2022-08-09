@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
        <li class="breadcrumb-item active">STOCK</li>
    </ul>
    <h1 class="page-header">
        Update Password
    </h1>
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4" >
        <div class="card h-100 p-4">
            <form method="post" action="{{ route('admin.profile.password.update') }}" class="container">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mb-3">
                            <label for="usd" class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" value=""/>
                            @error('password')
							    <span class="text-danger">{{ $message }}</span>
						    @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-3">
                            <label for="zwl" class="form-label">Confirm Password:</label>
                            <input type="password" name="password_confirmation" class="form-control" value=""/>
                            @error('password_confirmation')
							    <span class="text-danger">{{ $message }}</span>
						    @enderror
                        </div>
                    </div>
                </div>
                   
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-outline-success">Update Password</button>
                </div>
            </form>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
   

</div>
<!-- END #content -->

@endsection
@extends('backend._layouts.master')

@section('backend.master')



<!-- BEGIN #content -->
<div id="content" class="app-content">
    <div class="card">
        <div class="card-body p-0">
            <!-- BEGIN profile -->
            <div class="profile">
                <!-- BEGIN profile-container -->
                <div class="profile-container">
                    <!-- BEGIN profile-sidebar -->
                    <div class="profile-sidebar">
                        <div class="desktop-sticky-top">
                            <div class="nav-field">Product Thumbnail</div>
                            <div class="profile-img">
                                <img src="assets/img/user/profile.jpg" alt="" />
                            </div>
                            <!-- profile info -->
                            <hr class="mt-4 mb-4" />
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="nav-field mb-2">Categories</div>
                                    <select class="form-select mb-3">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>Default select</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="mt-4 mb-4" />

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="nav-field mb-2">Brands</div>
                                    <select class="form-select mb-3">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>Default select</option>
                                    </select>
                                </div>
                            </div>


                            <hr class="mt-4 mb-4" />

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="nav-field mb-2">Tags</div>
                                    <select class="form-select mb-3">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>Default select</option>
                                    </select>
                                </div>
                            </div>
                                            
                            <hr class="mt-4 mb-4" />
                    
                        </div>
                    </div>
                    <!-- END profile-sidebar -->
            
                    <!-- BEGIN profile-content -->
                    <div class="profile-content">
                        <ul class="profile-tab nav nav-tabs nav-tabs-v2">
                            <li class="nav-item">
                                <a href="#details" class="nav-link active" data-bs-toggle="tab">
                                    <div class="nav-field">Product Details</div>
                                    <!-- <div class="nav-value">382</div> -->
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#stock" class="nav-link" data-bs-toggle="tab">
                                    <div class="nav-field">Stock</div>
                                    <!-- <div class="nav-value">1.3m</div> -->
                                </a>
                            </li>
                        </ul>
                        <form method="post" action="{{ route('admin.product.store') }}">
                            @csrf
                            <div class="profile-content-container">
                                <div class="row gx-4">
                                    <div class="col-xl-12">
                                        <div class="tab-content p-0">
                                            <!-- BEGIN tab-pane -->
                                            <div class="tab-pane fade show active" id="details">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5 class=" mb-3">Basic Information</h5>
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="product_name">Product Name:</label>
                                                            <input type="name" class="form-control" id="product_name" placeholder="Product Name">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="product_name">Barcode:</label>
                                                            <input type="name" class="form-control" id="barcode" placeholder="Barcode">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label" for="zwl">ZWL:</label>
                                                                    <input type="name" name="zwl" class="form-control" id="zwl" placeholder="Product Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label" for="usd">USD:</label>
                                                                    <input type="name" name="usd" class="form-control" id="usd" placeholder="Product Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-arrow">
                                                        <div class="card-arrow-top-left"></div>
                                                        <div class="card-arrow-top-right"></div>
                                                        <div class="card-arrow-bottom-left"></div>
                                                        <div class="card-arrow-bottom-right"></div>
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5 class="mb-3">Specifications</h5>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label" for="spec_name">Name:</label>
                                                                    <input type="name" name="spec_name[]" class="form-control" id="spec_name" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label" for="spec_value">Value:</label>
                                                                    <input type="name" name="spec_value[]" class="form-control" id="spec_value" placeholder="Value">
                                                                </div>
                                                            </div>
                                                        </div>
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
                                            <div class="tab-pane fade" id="stock">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5 class="mb-3">Product Quantity</h5>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-label" for="spec_name">Quantity</label>
                                                                    <input type="name" name="quantity" class="form-control" id="spec_name" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
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
                                                        <button type="submit" class="btn btn-outline-success">Add Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END -->
                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
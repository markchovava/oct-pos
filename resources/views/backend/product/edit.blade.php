@extends('backend._layouts.master')

@section('backend.master')



<!-- BEGIN #content -->
<div id="content" class="app-content">
    <div class="card">
        <div class="card-body p-0">
            <form method="post" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            <!-- BEGIN profile -->
            <div class="profile">
                <!-- BEGIN profile-container -->
                <div class="profile-container">
                    <!-- BEGIN profile-sidebar -->
                    <div class="profile-sidebar">
                        <div class="desktop-sticky-top">
                            <div class="desktop-sticky-top img__area">
                                <div class="nav-field mb-3">Thumbnail</div>
                                <div class="mb-3 img__aspect5by4" 
                                style="border-radius:5px; border:1px solid rgba(255,255,255,.3)">
                                    <img src="{{ (!empty($product->image)) ? url('storage/products/thumbnail/' . $product->image) : url('storage/products/thumbnail/no_image.jpg') }}"
                                    style="width:100%; height:100%; object-fit:cover;" />
                                </div>
                                <div class="form-group mb-3">
                                    <input type="file" name="image" class="img__thumbnail form-control">
                                </div>

                                <!--  -->
                                <hr class="mt-4 mb-4" />
                                <div class="row category__row">
                                    <div class="col-sm-12 ">
                                        <div class="nav-field mb-4">Categories
                                            <button type="button" style="float:right"
                                            class="btn btn-sm btn-outline-success add__categoryBtn">
                                                <i class="far fa-fw fa-clone"></i>
                                            </button>
                                        </div>
                                        <section class="category__insert">
                                            <div class="category__select mb-4 display__none">
                                                <select class="form-select mb-2 category">
                                                    <option value="">Default select</option>
                                                    @if( isset($categories) )
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Brands.</option>
                                                    @endif
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove__categoryBtn">
                                                    <i class="fas fa-fw fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="category__select mb-4">
                                                <select name="category[]" class="form-select mb-2">
                                                    <option value="">Default select</option>
                                                    @if( isset($categories) )
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Brands.</option>
                                                    @endif
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove__categoryBtn">
                                                    <i class="fas fa-fw fa-times"></i>
                                                </button>
                                            </div>
                                        </section>
                                        <section class="category__insertDB">
                                            @if( isset($product->categories) )
                                                @foreach($product->categories as $category)
                                                    <div class="category__select mb-4">
                                                        <select name="category[]" class="form-select mb-2">
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        </select>
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove__categoryBtn">
                                                            <i class="fas fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </section>
                                    </div>
                                </div>
                                <!--  -->
                                <!--  -->
                                <hr class="mt-4 mb-4" />
                                <div class="row brand__row">
                                    <div class="col-sm-12">
                                        <div class="nav-field mb-4">Brands
                                            <button type="button" style="float:right"
                                            class="btn btn-sm btn-outline-success add__brandBtn">
                                                <i class="far fa-fw fa-clone"></i>
                                            </button>
                                        </div>
                                        <section class="brand__insert">
                                            <div class="brand__select mb-4 display__none">
                                                <select class="form-select mb-2 brand">
                                                    <option value="">Default select</option>
                                                    @if( isset($brands) )
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Brands.</option>
                                                    @endif
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove__brandBtn">
                                                    <i class="fas fa-fw fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="brand__select mb-4">
                                                <select name="brand[]" class="form-select mb-2 brand">
                                                    <option value="">Default select</option>
                                                    @if( isset($brands) )
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Brands.</option>
                                                    @endif
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove__brandBtn">
                                                    <i class="fas fa-fw fa-times"></i>
                                                </button>
                                            </div>
                                        </section>
                                        <section class="brand__insertDB">
                                            @if( isset($product->categories) )
                                                @foreach($product->brands as $brand)
                                                    <div class="brand__select mb-4">
                                                        <select name="brand[]" class="form-select mb-2 brand">
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        </select>
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove__brandBtn">
                                                            <i class="fas fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                @endforeach 
                                            @endif
                                        </section>
                                    </div>
                                </div>
                                <hr class="mt-4 mb-4" />
                                
                            </div>
                
                            
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
                                                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name" placeholder="Product Name">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="product_name">Barcode:</label>
                                                        <input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control" id="barcode" placeholder="Barcode">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="zwl">ZWL:</label>
                                                                <input type="number" name="zwl" value="{{ $price->zwl }}" class="form-control" id="zwl" placeholder="Product Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="usd">USD:</label>
                                                                <input type="number" name="usd" value="{{ $price->usd }}" class="form-control" id="usd" placeholder="Product Name">
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
                                                                <input type="number" name="quantity" value="{{ $stock->quantity }}" class="form-control" placeholder="Quantity">
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
                                                    <button type="submit" class="btn btn-outline-success">Update Product</button>
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
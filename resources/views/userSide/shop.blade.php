@extends('layouts.masterUserSide.master')
@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop List</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Category Filter -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Filter by category</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <form method="GET" action="{{ route('shop') }}">
                    <select class="form-control mb-3" name="category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Price Filter -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Filter by price</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <form method="GET" action="{{ route('shop') }}">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="0-5" id="price-1" {{ in_array('0-5', (array)request('price')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="price-1">$0 - $5</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="5-10" id="price-2" {{ in_array('5-10', (array)request('price')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="price-2">$5 - $10</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" name="price[]" value="10-20" id="price-3" {{ in_array('10-20', (array)request('price')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="price-3">$10 - $20</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Apply Filter</button>
                </form>
            </div>
            <!-- End Price Filter -->


            <!-- Pagination Start -->
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
            <!-- Pagination End -->



        </div>

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                @if($product->productImages && $product->productImages->isNotEmpty())
                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="{{ $product->name }}">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset('default-image.jpg') }}" alt="{{ $product->name }}">
                                @endif
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{url('productDetails', $product->id)}}"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="{{url('productDetails', $product->id)}}">{{ $product->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${{ number_format($product->price, 2) }}</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    @for ($i = 0; $i < 5; $i++)
                                        <small class="fa fa-star {{ $i < $product->ratings->avg('rating') ? 'text-primary' : 'text-muted' }} mr-1"></small>
                                    @endfor
                                    <small>({{ $product->ratings->count() }})</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination Start -->
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
                <!-- Pagination End -->

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection

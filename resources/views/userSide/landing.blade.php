@extends('layouts.masterUserSide.master')
@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row justify-content-center px-xl-5">
            <div class="col-12 col-xxl-10">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/sam.avif" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tech Essentials</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Top-quality chargers and accessories for your devices. Reliability you can count on</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="/shop?category=7">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/sam2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Power Solutions</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Find high-quality earbuds and charging cables to keep you connected and powered up all day</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="/shop?category=6">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/slid3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Audio Essentials</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="/shop?category=5">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->




    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Categories</span>
        </h2>
        <div class="row px-xl-5 pb-3">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="{{ route('shop', ['category' => $category->id]) }}">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid " src="{{asset('storage/' . $category->image)  }}" alt="{{ $category->name }}">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6>{{ $category->name }}</h6>
                                <small class="text-body">{{ $category->products_count }} Products</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Featured Products</span>
    </h2>
    <div class="row px-xl-5">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        @if($product->productImages->isNotEmpty())
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <img class="img-fluid w-100" src="{{ asset('default-image.jpg') }}" alt="{{ $product->name }}">
                        @endif
                        <div class="product-action">
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-outline-dark btn-square"><i class="fa fa-shopping-cart"></i></button>
                            </form>
                            {{-- <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-outline-dark btn-square">
                                    <i class="far fa-heart {{ Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id) ? 'text-danger' : '' }}"></i>
                                </button>
                            </form> --}}
                            <a class="btn btn-outline-dark btn-square" href="{{url('productDetails', $product->id)}}"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="{{url('productDetails', $product->id)}}">{{ $product->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${{ number_format($product->price, 2) }}</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            @php
                                $avgRating = $product->ratings->avg('rating') ?? 0;
                            @endphp
                            @for ($i = 0; $i < 5; $i++)
                                <small class="fa fa-star {{ $i < $avgRating ? 'text-primary' : 'text-muted' }} mr-1"></small>
                            @endfor
                            <small>({{ $product->ratings->count() }})</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Products End -->



    <!-- Offer Start -->
    <!-- <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Offer End -->

@endsection

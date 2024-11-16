@extends('layouts.masterUserSide.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <!-- Product Image Carousel -->
            <div class="col-lg-5 mb-4">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @if(optional($product->productImages)->isNotEmpty())
                            @foreach($product->productImages as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img class="img-fluid w-100" src="{{ asset('default-image.jpg') }}" alt="{{ $product->name }}">
                            </div>
                        @endif
                    </div>
                    @if($product->productImages->count() > 1)
                        <a class="carousel-control-prev" href="#product-carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="col-lg-7 mb-4">
                <div class="bg-light p-4 border">
                    <h3 class="font-weight-bold">{{ $product->name }}</h3>

                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning mr-2">
                            @php
                                $avgRating = $product->ratings->avg('rating') ?? 0;
                            @endphp
                            @for($i = 0; $i < 5; $i++)
                                <small class="fa fa-star {{ $i < $avgRating ? 'text-primary' : 'text-muted' }}"></small>
                            @endfor
                        </div>
                        <small>({{ $product->ratings->count() }} Reviews)</small>
                    </div>

                    <h3 class="font-weight-bold text-success mb-4">${{ number_format($product->price, 2) }}</h3>
                    <p class="mb-4">{{ $product->description }}</p>

                    <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center mb-4 pt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="number" name="quantity" class="form-control bg-secondary border-0 text-center" value="1" min="1">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3">
                            <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-3">
                            Reviews ({{ $product->ratings->count() }})
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-pane-3">
                            <div class="row">
                                <!-- Existing Reviews -->
                                <div class="col-md-6">
                                    <h4 class="mb-4">Product Reviews</h4>
                                    @forelse($product->ratings as $rating)
                                        <div class="media mb-4">
                                            <div class="media-body">
                                                <h6>{{ $rating->user->name }}<small> - <i>{{ $rating->created_at->format('d M Y') }}</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    @for($i = 0; $i < 5; $i++)
                                                        <i class="fas fa-star {{ $i < $rating->rating ? 'text-primary' : 'text-muted' }}"></i>
                                                    @endfor
                                                </div>
                                                <p>{{ $rating->comment }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No reviews yet.</p>
                                    @endforelse
                                </div>

                                <!-- Review Form -->
                                @auth
                                    @php
                                        $hasPurchased = Auth::user()->orders()
                                            ->whereHas('orderItems', function($query) use ($product) {
                                                $query->where('product_id', $product->id);
                                            })
                                            ->where('status', 'completed')
                                            ->exists();
                                    @endphp

                                    <div class="col-md-6">
                                        <h4 class="mb-4">Leave a review</h4>
                                        @if($hasPurchased)
                                            <form action="{{ route('ratings.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                <div class="d-flex my-3">
                                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                                    <div class="rating-stars">
                                                        @for($i = 5; $i >= 1; $i--)
                                                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" required>
                                                            <label for="star{{ $i }}"><i class="far fa-star"></i></label>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="comment">Your Review *</label>
                                                    <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" required></textarea>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <input type="submit" value="Submit Review" class="btn btn-primary px-3">
                                                </div>
                                            </form>
                                        @else
                                            <div class="alert alert-info">
                                                You need to purchase this product before you can leave a review.
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="alert alert-info">
                                            Please <a href="{{ route('login') }}">login</a> to leave a review.
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="bg-secondary pr-3">Similar Products</span>
            </h2>
            <div class="row px-xl-5">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                @if($relatedProduct->productImages->isNotEmpty())
                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $relatedProduct->productImages->first()->image_path) }}" alt="{{ $relatedProduct->name }}">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset('default-image.jpg') }}" alt="{{ $relatedProduct->name }}">
                                @endif

                                <div class="product-action">
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-outline-dark btn-square">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                        <button type="submit" class="btn btn-outline-dark btn-square">
                                            <i class="far fa-heart {{ Auth::check() && Auth::user()->wishlists->contains('product_id', $relatedProduct->id) ? 'text-danger' : '' }}"></i>
                                        </button>
                                    </form>
                                    <a class="btn btn-outline-dark btn-square" href="{{ url('productDetails', $relatedProduct->id) }}">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="{{ url('productDetails', $relatedProduct->id) }}">
                                    {{ $relatedProduct->name }}
                                </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${{ number_format($relatedProduct->price, 2) }}</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    @php
                                        $avgRating = $relatedProduct->ratings->avg('rating') ?? 0;
                                    @endphp
                                    @for($i = 0; $i < 5; $i++)
                                        <small class="fa fa-star {{ $i < $avgRating ? 'text-primary' : 'text-muted' }} mr-1"></small>
                                    @endfor
                                    <small>({{ $relatedProduct->ratings->count() }})</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Quantity spinner
        $('.btn-plus').on('click', function() {
            var input = $(this).closest('.quantity').find('input');
            input.val(parseInt(input.val()) + 1);
        });

        $('.btn-minus').on('click', function() {
            var input = $(this).closest('.quantity').find('input');
            if (parseInt(input.val()) > 1) {
                input.val(parseInt(input.val()) - 1);
            }
        });

        // Rating stars
        $('.rating-stars label').hover(
            function() {
                $(this).prevAll('label').addBack().find('i').removeClass('far').addClass('fas');
            },
            function() {
                if (!$(this).siblings('input:checked').length) {
                    $(this).prevAll('label').addBack().find('i').removeClass('fas').addClass('far');
                }
            }
        );

        $('.rating-stars input').change(function() {
            var $star = $(this);
            $('.rating-stars label').find('i').removeClass('fas').addClass('far');
            $star.prevAll('input').addBack().next('label').find('i').removeClass('far').addClass('fas');
        });
    });
</script>
@endpush

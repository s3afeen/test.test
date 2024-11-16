@extends('layouts.masterUserSide.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                    <span class="breadcrumb-item active">Wishlist</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Wishlist Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Add to Cart</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @forelse($wishlistItems as $item)
                                <tr>
                                    <td class="align-middle">
                                        <img src="{{ $item->product->productImages->first() ? asset('storage/' . $item->product->productImages->first()->image_path) : asset('default-image.jpg') }}"
                                             alt="{{ $item->product->name }}"
                                             style="width: 50px;">
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="align-middle">${{ number_format($item->product->price, 2) }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-shopping-cart"></i> Add to Cart
                                            </button>
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="remove-from-wishlist-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        Your wishlist is empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist End -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Add to cart
    $('.add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                location.reload();
            }
        });
    });

    // Remove from wishlist
    $('.remove-from-wishlist-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                location.reload();
            }
        });
    });
});
</script>
@endpush

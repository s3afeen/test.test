@extends('layouts.masterUserSide.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('shop') }}">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse($cartItems as $item)
                        <tr data-id="{{ $item->id }}">
                            <td class="align-middle">
                                <img src="{{ $item->product->productImages->first() ? asset('storage/' . $item->product->productImages->first()->image_path) : asset('default-image.jpg') }}"
                                     alt="{{ $item->product->name }}"
                                     style="width: 50px;">
                                {{ $item->product->name }}
                            </td>
                            <td class="align-middle">${{ number_format($item->product->price, 2) }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center"
                                           value="{{ $item->quantity }}" min="1">
                                    <div class="input-group-btn">
                                    </div>
                                </div>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="update-quantity-form" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="quantity" class="form-control form-control-sm bg-secondary border-0 text-center"
                                    value="{{ $item->quantity }}" min="1">
                                </form>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Your cart is empty
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Summary</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>${{ number_format($cartItems->sum(function($item) {
                                return $item->quantity * $item->product->price;
                            }), 2) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10.00</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>${{ number_format($cartItems->sum(function($item) {
                                return $item->quantity * $item->product->price;
                            }) + 10, 2) }}</h5>
                        </div>
                        <form id="checkout-form" method="POST" action="{{ route('cart.checkout') }}">
                            @csrf
                            <button type="submit" class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkoutBtn">
                                Proceed To Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#checkout-form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const button = form.find('#checkoutBtn');

        // Disable button and show loading state
        button.prop('disabled', true).html('Processing...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    alert(response.message);
                    // Redirect to orders page
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr) {
                // Show error message
                alert('Something went wrong. Please try again.');
                // Reset button state
                button.prop('disabled', false).html('Proceed To Checkout');
            }
        });
    });

    // Existing quantity update code
    $('.btn-plus, .btn-minus').on('click', function (e) {
        e.preventDefault();
        const button = $(this);
        const isPlus = button.hasClass('btn-plus');
        const input = button.closest('.quantity').find('input');
        let value = parseInt(input.val());

        if (isPlus) {
            value++;
        } else if (value > 1) {
            value--;
        }

        input.val(value);

        const form = button.closest('tr').find('form.update-quantity-form');
        form.find('input[name="quantity"]').val(value);
        form.submit();
    });
});
</script>
@endpush

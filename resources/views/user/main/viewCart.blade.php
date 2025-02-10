@extends('user.layouts.master')
@section('container')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="mb-5 col-lg-8 table-responsive">
            <table class="table mb-0 text-center table-light table-borderless table-hover" id='dataTable'>
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartList as $cart )
                    {{--  @dd($cart);  --}}
                    <tr id="cart-row-{{ $cart['id'] }}">
                        <!-- Add unique ID for each row -->
                        <td class="align-middle"><img src="{{ asset('storage/'.$cart['pizza_image']) }}" alt=""
                                style="width: 50px;"></td>
                        <td class="align-middle">{{ $cart['pizza_name'] }}</td>
                        <input type="hidden" name="cart_id" value="{{ $cart['card_id'] }}" class="cart_id">
                        <input type="hidden" name="user_id" value="{{ $cart['user_id'] }}" class="user">
                        <input type="hidden" name="product_id" value="{{ $cart['product_id'] }}" class="item">
                        <td class="align-middle pizza_price">{{ $cart['pizza_price'] }}</td>
                        <td class="align-middle">
                            <div class="mx-auto input-group quantity" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                                <input type="text"
                                    class="text-center border-0 form-control form-control-sm bg-secondary qty"
                                    value="{{ $cart['qty'] }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle total_price">{{ $cart['pizza_price'] * $cart['qty'] }}</td>
                        <td class="align-middle btn-remove">
                            <button class="btn btn-sm btn-danger "><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-lg-4">
            <h5 class="mb-3 section-title position-relative text-uppercase"><span class="pr-3 bg-secondary">Cart
                    Summary</span></h5>
            <div class="mb-5 bg-light p-30">
                <div class="pb-2 border-bottom">
                    <div class="mb-3 d-flex justify-content-between">
                        <h6>Subtotal</h6>
                        <h6 class="sub_total">{{ $totalPrice }}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">{{ $shipping }}</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="mt-2 d-flex justify-content-between">
                        <h5>Total</h5>
                        <h5 id="total">{{ $totalPrice + $shipping }}</h5>
                    </div>
                    <button class="py-3 my-3 btn btn-block btn-primary font-weight-bold btn-order"
                        id="order-btn">Proceed To
                        Checkout</button>
                        {{--  <button id="checkoutButton" class="btn btn-primary">Proceed to Checkout</button>  --}}
                        <div style="width:100px; height:200px;"> <!-- Set the desired size here -->
                            <div style="transform: scale(0.5); transform-origin: top left;">
                                {{--  {!! DNS2D::getBarcodeHTML("
                                name : thuriya ,
                                items : 4 ,
                                total price : 43000 ,
                                payment method : bermudaPay
                                ", 'QRCODE') !!}  --}}
                            </div>
                        </div>
                        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModalLabel">Order Summary</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <input type="hidden" id="user_name" value="{{ Auth::user()->name }}">

                                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}" class="user">
                                    <div class="modal-body">
                                        <p><strong>Name :</strong> <span id="name-display"></span></p>
                                        <p><strong>Order Code:</strong> <span id="order-code-display"></span></p>
                                        <p><strong>Total Price:</strong> <span id="order-total-display"></span></p>
                                        <p><strong>Payment Method:</strong> <span id="payment-method-display">BermudaPay</span></p>
                                        <div id="qr-code-display" class="mt-3 text-center"></div> <!-- QR Code will appear here -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" id="confirmOrder">Confirm Order</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="qr-code-container" class="mt-4 text-center">
    <!-- QR Code will appear here -->
</div>

<!-- JavaScript to handle the delete action -->

@endsection

@section('scriptSource')
<script>
    $(document).ready(function () {
        // Function to update subtotal and total in the cart summary
        function updateCartSummary() {
            let subtotal = 0;
            $('.total_price').each(function () {
                let itemTotal = parseFloat($(this).text()) || 0;
                subtotal += itemTotal;
            });

            $('.sub_total').text(subtotal.toFixed(2));

            let shipping = parseFloat('{{ $shipping }}');
            $('#total').text((subtotal + shipping).toFixed(2));
        }

        // Event handler for the plus button
        $(document).on('click', '.btn-plus', function () {
            let $parentNode = $(this).closest("tr");
            let $qtyInput = $parentNode.find('.qty');
            let $cartInput = $parentNode.find('.cart_id');
            let $itemInput = $parentNode.find('.item');
            let $userInput = $parentNode.find('.user');
            let price = parseFloat($parentNode.find('.pizza_price').text()) || 0;
            let qty = parseInt($qtyInput.val()) || 0;
            let itemId = parseInt($itemInput.val()) || 0;
            let userId = parseInt($userInput.val()) || 0;
            let cartId = parseInt($cartInput.val()) || 0;
            {{--  let itemId = $parentNode.data('product_id'); // Assuming each row has a data attribute for item ID
            let userId = $parentNode.data('user_id');  --}}
            // Update total price for the row
            $parentNode.find('.total_price').text((price * qty).toFixed(2));

            // Update cart summary
            updateCartSummary();

            // CSRF token
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: 'http://127.0.0.1:8000/ajax/updateForButtons',
                type: 'POST',
                data: JSON.stringify({ item_id: itemId, qty: qty , user_id : userId , cart_id :cartId  }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    console.log('Update successful:', response);
                    console.log(qty);
                    console.log(itemId);
                    console.log(userId);
                    console.log(cartId);
                    // Optionally, update the UI based on the response
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                    alert("An error occurred while updating the cart. Please try again.");
                }
            });
        });

        // Event handler for the minus button
        $(document).on('click', '.btn-minus', function () {
            let $parentNode = $(this).closest("tr");
            let $qtyInput = $parentNode.find('.qty');
            let $cartInput = $parentNode.find('.cart_id');
            let $itemInput = $parentNode.find('.item');
            let $userInput = $parentNode.find('.user');
            let price = parseFloat($parentNode.find('.pizza_price').text()) || 0;
            let qty = parseInt($qtyInput.val()) || 0;
            let itemId = parseInt($itemInput.val()) || 0;
            let userId = parseInt($userInput.val()) || 0;
            let cartId = parseInt($cartInput.val()) || 0;
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Decrement quantity if greater than 1

                {{--  qty--;  --}}
                $qtyInput.val(qty);

                // Update total price for the row
                $parentNode.find('.total_price').text((price * qty).toFixed(2));
                console.log(qty);
                // Update cart summary
                updateCartSummary();
                $.ajax({
                    url: 'http://127.0.0.1:8000/ajax/updateForButtons',
                    type: 'POST',
                    data: JSON.stringify({ item_id: itemId, qty: qty , user_id : userId , cart_id :cartId  }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        console.log('Update successful:', response);
                        console.log(qty);
                        console.log(itemId);
                        console.log(userId);
                        console.log(cartId);
                        // Optionally, update the UI based on the response
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        console.error('Response:', xhr.responseText);
                        alert("An error occurred while updating the cart. Please try again.");
                    }
                });
        });

        // Event handler for the remove button
        $(document).on('click', '.btn-remove', function () {
            let $parentNode = $(this).closest("tr");
    let $cartInput = $parentNode.find('.cart_id');
    let cartId = parseInt($cartInput.val()) || 0;
console.log(cartId);
    // CSRF token
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: 'http://127.0.0.1:8000/ajax/remove',
        type: 'POST',
        data: JSON.stringify({ cart_id: cartId }),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            console.log('Removal successful:', response);
            // Remove the row from the table
            $parentNode.remove();
            // Update cart summary after removing the row
            updateCartSummary();
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            console.error('Response:', xhr.responseText);
            alert("An error occurred while removing the item from the cart. Please try again.");
        }
    });
        });

        {{--  $('#order-btn').click(function () {
            let url = 'http://127.0.0.1:8000/ajax/generate-qr-code';;
            let orderCode = 'ORD-' + Date.now(); // Example order code
            let totalValue = parseFloat($('#total').text()) || 0;

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    order_code: orderCode,
                    total_value: totalValue,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    console.log(response.message);

                    // Display the QR code
                    $('#qr-code-container').html(`<img src="${response.qr_code_url}" alt="QR Code" />`);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });  --}}
        $(document).ready(function () {
            $('#order-btn').click(function () {
                const homeUrl = 'http://127.0.0.1:8000/user/home';
                let url = 'http://127.0.0.1:8000/ajax/order';
                let orderList = [];
                let totalValue = parseFloat($('#total').text()) || 0;
                let userName = $('#user_name').val() || "Guest";
                // Generate a unique order code (timestamp-based)
                let orderCode = 'ORD-' + Date.now();

                // Loop through cart rows and collect data
                $('#dataTable tbody tr').each(function () {
                    {{--  let userId = $(this).find('.user_id').val();
                    let productId = $(this).find('.product_id').val();  --}}
                    let userId = $('.user').val();
                    let productId = $('.item').val();
                    let qty = parseInt($(this).find('.qty').val()) || 0;
                    let price = parseFloat($(this).find('.pizza_price').text()) || 0;
                    let itemTotal = qty * price; // Calculate total value for this item
                    console.log('hello this is userID',);
                    if (qty > 0) {
                        orderList.push({
                            user_id: userId,
                            product_id: productId,
                            qty: qty,
                            total_value: itemTotal,
                            order_code: orderCode,
                        });
                    }
                });

                if (orderList.length === 0) {
                    alert("No items in the cart to place an order.");
                    return;
                }

                // Order Data for QR Code
                let orderData = JSON.stringify({
                    name: "Thuriya",
                    items: orderList.length,
                    total_price: totalValue,
                    payment_method: "BermudaPay"
                });

                // Display Order Summary in Modal
                $('#order-code-display').text(orderCode);
                $('#order-total-display').text(totalValue);
                $('#name-display').text(userName);
                // Generate QR Code using Laravel's DNS2D
                $.ajax({
                    url: 'http://127.0.0.1:8000/ajax/generate-qr',
                    type: 'POST',
                    data: { order_data: orderData, _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        $('#qr-code-display').html(response.qr_code);

                        // Properly open the Bootstrap modal
                        var orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
                        orderModal.show();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error generating QR code:', error);
                    }
                });

                // Handle Confirm Order Button
                $('#confirmOrder').off('click').on('click', function () {
                    let requestData = {
                        name :userName ,
                        order_code: orderCode,
                        total_value: totalValue,
                        order_list: orderList,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    // Send AJAX request to place the order
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: JSON.stringify(requestData),
                        contentType: 'application/json',
                        success: function (response) {
                            console.log('Order placed successfully:', response);
                            alert(response.message);
                            window.location.href = homeUrl;
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            console.error('Response:', xhr.responseText);
                            alert("An error occurred while placing the order. Please try again.");
                        }
                    });

                    // Close the modal after confirmation
                    $('#orderModal').modal('hide');
                });
            });
        });

            // Cancel Order Button
            $('#cancelOrder').click(function () {
                $('#orderModal').hide();
            });
        });


        // Function to update subtotal and total in cart summary


</script>



@endsection

@extends('user.layouts.master')

@section('container')
<div class="py-4 container-fluid px-xl-5" style="background-color: #f5e8d8;">
    <div class="row">
        <div class="mb-5 col-lg-8">
            <h5 class="mb-4 fw-bold text-uppercase" style="color: #8B4513;">Your Cart</h5>
            <div class="rounded shadow-sm table-responsive" style="background-color: #fff;">
                <table class="table mb-0 text-center table-hover" id="dataTable">
                    <thead style="background-color: #D2B48C; color: #fff;">
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
                        @foreach ($cartList as $cart)
                        <tr id="cart-row-{{ $cart['id'] }}">
                            <td class="align-middle"><img src="{{ asset('storage/' . $cart['pizza_image']) }}" alt="{{ $cart['pizza_name'] }}" style="width: 50px; border-radius: 5px;"></td>
                            <td class="align-middle fw-semibold" style="color: #8B4513;">{{ $cart['pizza_name'] }}</td>
                            <input type="hidden" name="cart_id" value="{{ $cart['card_id'] }}" class="cart_id">
                            <input type="hidden" name="user_id" value="{{ $cart['user_id'] }}" class="user">
                            <input type="hidden" name="product_id" value="{{ $cart['product_id'] }}" class="item">
                            <td class="align-middle pizza_price">{{ number_format($cart['pizza_price'], 0) }} Kyats</td>
                            <td class="align-middle">
                                <div class="mx-auto input-group quantity" style="width: 100px;">
                                    <button class="shadow-sm btn btn-sm btn-minus" style="background-color: #8B4513; color: #fff; border: none;"><i class="bi bi-dash"></i></button>
                                    <input type="text" class="text-center border-0 form-control form-control-sm qty" value="{{ $cart['qty'] }}" readonly style="background-color: #fff;">
                                    <button class="shadow-sm btn btn-sm btn-plus" style="background-color: #8B4513; color: #fff; border: none;"><i class="bi bi-plus"></i></button>
                                </div>
                            </td>
                            <td class="align-middle total_price">{{ number_format($cart['pizza_price'] * $cart['qty'], 0) }} Kyats</td>
                            <td class="align-middle btn-remove">
                                <button class="shadow-sm btn btn-sm" style="background-color: #A0522D; color: #fff; border: none;"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <h5 class="mb-3 fw-bold text-uppercase" style="color: #8B4513;">Cart Summary</h5>
            <div class="p-4 mb-5 rounded shadow-sm" style="background-color: #fff;">
                <div class="pb-2 border-bottom" style="border-color: #D2B48C;">
                    <div class="mb-3 d-flex justify-content-between">
                        <h6 style="color: #8B4513;">Subtotal</h6>
                        <h6 class="sub_total" style="color: #8B4513;">{{ number_format($totalPrice, 0) }} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium" style="color: #8B4513;">Shipping</h6>
                        <h6 class="font-weight-medium" style="color: #8B4513;">{{ number_format($shipping, 0) }} Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="mt-2 d-flex justify-content-between">
                        <h5 style="color: #8B4513;">Total</h5>
                        <h5 id="total" style="color: #8B4513;">{{ number_format($totalPrice + $shipping, 0) }} Kyats</h5>
                    </div>
                    <button class="py-3 my-3 shadow-sm btn btn-block fw-bold" id="order-btn" style="background-color: #8B4513; color: #fff; border: none; border-radius: 10px; transition: background-color 0.3s;">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="shadow-lg modal-content" style="background-color: #f5e8d8; border-radius: 10px;">
            <div class="modal-header" style="background-color: #8B4513; color: #fff; border-bottom: 2px solid #D2B48C;">
                <h5 class="modal-title fw-bold" id="orderModalLabel">🧾 Order Receipt</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="p-4 modal-body">
                <input type="hidden" id="user_name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}" class="user">
                <div class="text-center">
                    <h5 class="fw-bold" style="color: #8B4513;">🍕 Your Order</h5>
                    <p class="text-muted">Thank you for choosing us!</p>
                </div>
                <hr style="border-top: 2px dashed #D2B48C;">
                <div class="px-3">
                    <p class="d-flex justify-content-between"><strong style="color: #8B4513;">👤 Name:</strong> <span id="name-display"></span></p>
                    <p class="d-flex justify-content-between"><strong style="color: #8B4513;">🆔 Order Code:</strong> <span id="order-code-display"></span></p>
                    <p class="d-flex justify-content-between"><strong style="color: #8B4513;">💰 Total Price:</strong> <span id="order-total-display"></span></p>
                    <p class="d-flex justify-content-between align-items-center">
                        <strong style="color: #8B4513;">💳 Payment Method:</strong>
                        <select name="payment_method" id="payment_method" class="shadow-sm form-select w-50" style="border-color: #8B4513;">
                            <option value="kbz_payment">KBZ</option>
                            <option value="aya_payment">AYA</option>
                            <option value="a+_payment">A+</option>
                            <option value="wave_payment">WAVE</option>
                        </select>
                    </p>
                </div>
                <hr style="border-top: 2px dashed #D2B48C;">
                <div class="text-center">
                    <small class="text-muted">Questions? Contact us at support@caffeinecorner.com</small>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; justify-content: center;">
                <button type="button" class="mt-2 shadow-sm btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #8B4513; color: #8B4513;">Cancel</button>
                <button type="button" id="confirmOrder" class="shadow-sm btn fw-bold" style="background-color: #D2B48C; color: #fff; border: none; border-radius: 10px;">✅ Confirm Order</button>
            </div>
        </div>
    </div>
</div>

<div id="qr-code-container" class="mt-4 text-center d-none"></div>
@endsection

@section('scriptSource')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        function updateCartSummary() {
            let subtotal = 0;
            $('.total_price').each(function () {
                let itemTotal = parseFloat($(this).text().replace(/[^0-9.-]+/g, '')) || 0;
                subtotal += itemTotal;
            });
            $('.sub_total').text(subtotal.toLocaleString() + ' Kyats');
            let shipping = parseFloat('{{ $shipping }}') || 0;
            $('#total').text((subtotal + shipping).toLocaleString() + ' Kyats');
        }

        $('.btn-plus').click(function () {
            let $row = $(this).closest('tr');
            let $qtyInput = $row.find('.qty');
            let qty = parseInt($qtyInput.val()) ;
            $qtyInput.val(qty);
            updateRow($row, qty);
        });

        $('.btn-minus').click(function () {
            let $row = $(this).closest('tr');
            let $qtyInput = $row.find('.qty');
            let qty = parseInt($qtyInput.val()) ;
            if (qty >= 1) { // Ensure quantity doesn't go below 1
                $qtyInput.val(qty);
                updateRow($row, qty);
            }
        });

        function updateRow($row, qty) {
            let price = parseFloat($row.find('.pizza_price').text().replace(/[^0-9.-]+/g, '')) || 0;
            let cartId = $row.find('.cart_id').val();
            let userId = $row.find('.user').val();
            let productId = $row.find('.item').val();
            $row.find('.total_price').text((price * qty).toLocaleString() + ' Kyats');
            updateCartSummary();

            $.ajax({
                url: 'http://127.0.0.1:8000/ajax/updateForButtons',
                type: 'POST',
                data: JSON.stringify({ item_id: productId, qty: qty, user_id: userId, cart_id: cartId }),
                contentType: 'application/json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    console.log('Update successful:', response);
                    // Optional: Update UI with server response if needed
                },
                error: function (xhr) {
                    alert('Error updating cart: ' + xhr.responseText);
                    // Revert to previous quantity on error
                    $qtyInput.val(parseInt($qtyInput.val()) + 1); // Revert if minus, adjust for plus if needed
                    updateRow($row, parseInt($qtyInput.val()));
                }
            });
        }

        $('.btn-remove').click(function () {
            let $row = $(this).closest('tr');
            let cartId = $row.find('.cart_id').val();

            $.ajax({
                url: 'http://127.0.0.1:8000/ajax/remove',
                type: 'POST',
                data: JSON.stringify({ cart_id: cartId }),
                contentType: 'application/json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () {
                    $row.remove();
                    updateCartSummary();
                },
                error: function (xhr) {
                    alert('Error removing item: ' + xhr.responseText);
                }
            });
        });

        $('#order-btn').click(function () {
            let totalValue = parseFloat($('#total').text().replace(/[^0-9.-]+/g, '')) || 0;
            let userName = $('#user_name').val() || 'Guest';
            let orderCode = 'ORD-' + Date.now();
            let orderList = [];

            $('#dataTable tbody tr').each(function () {
                let userId = $(this).find('.user').val();
                let productId = $(this).find('.item').val();
                let qty = parseInt($(this).find('.qty').val()) || 0;
                let price = parseFloat($(this).find('.pizza_price').text().replace(/[^0-9.-]+/g, '')) || 0;
                if (qty > 0) {
                    orderList.push({ user_id: userId, product_id: productId, qty: qty, total_value: price * qty, order_code: orderCode });
                }
            });

            if (orderList.length === 0) {
                alert('No items in the cart.');
                return;
            }

            $('#order-code-display').text(orderCode);
            $('#order-total-display').text(totalValue.toLocaleString() + ' Kyats');
            $('#name-display').text(userName);
            $('#orderModal').modal('show');
        });

        $('#confirmOrder').click(function () {
            let paymentMethod = $('#payment_method').val();
            let totalValue = parseFloat($('#total').text().replace(/[^0-9.-]+/g, '')) || 0;
            let userName = $('#user_name').val() || 'Guest';
            let orderCode = $('#order-code-display').text();
            let orderList = [];

            $('#dataTable tbody tr').each(function () {
                let userId = $(this).find('.user').val();
                let productId = $(this).find('.item').val();
                let qty = parseInt($(this).find('.qty').val()) || 0;
                let price = parseFloat($(this).find('.pizza_price').text().replace(/[^0-9.-]+/g, '')) || 0;
                if (qty > 0) {
                    orderList.push({ user_id: userId, product_id: productId, qty: qty, total_value: price * qty, order_code: orderCode });
                }
            });

            $.ajax({
                url: 'http://127.0.0.1:8000/ajax/order',
                type: 'POST',
                data: JSON.stringify({ name: userName, order_code: orderCode, total_value: totalValue, order_list: orderList, payment_method: paymentMethod }),
                contentType: 'application/json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    alert(response.message);
                    window.location.href = 'http://127.0.0.1:8000/user/anotherPage';
                },
                error: function (xhr) {
                    alert('Error placing order: ' + xhr.responseText);
                }
            });
            $('#orderModal').modal('hide');
        });

        $('#order-btn, #confirmOrder').hover(
            function() { $(this).css('background-color', '#A0522D'); },
            function() { $(this).css('background-color', $(this).attr('id') === 'order-btn' ? '#8B4513' : '#D2B48C'); }
        );
    });
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

<style>
    .btn:hover { opacity: 0.9; }
    .table td, .table th { border-color: #D2B48C; }
</style>

@extends('user.layouts.master')

@section('container')
<div class="pt-4 container-fluid px-xl-5" style="background-color: #f5e8d8;">
    <div class="row">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <div class="p-4 mb-4 rounded shadow-sm" style="background-color: #fff;">
                <h5 class="mb-3 fw-bold text-uppercase" style="color: #8B4513;">Filter by Category</h5>
                <form>
                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <a class="text-dark fw-semibold text-decoration-none hover-link" href="{{ route('user.orderMenu') }}">All Categories</a>
                        <span class="badge rounded-pill" style="background-color: #D2B48C; color: #fff;">{{ count($pizzaData) }}</span>
                    </div>
                    @foreach ($categories as $category)
                    <div class="mb-3">
                        <a href="{{ route('user.viewViaCategory', $category['category_id']) }}" class="shadow-sm btn w-100 text-start" style="background-color: #D2B48C; color: #fff; border: none; transition: background-color 0.3s;">
                            {{ $category['name'] }}
                        </a>
                    </div>
                    @endforeach
                </form>
            </div>
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="pb-3">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('user.history') }}" class="shadow-sm btn btn-outline-success">
                        <i class="bi bi-clock-history"></i> History
                    </a>
                    <a href="{{ route('user.cartList') }}" class="shadow-sm btn btn-outline-primary position-relative">
                        <i class="bi bi-cart"></i>
                        @if($cart && count($cart->toArray()) > 0)
                        <span class="badge bg-danger position-absolute rounded-circle" style="top: -5px; right: -5px; width: 20px; height: 20px; line-height: 15px;">{{ count($cart->toArray()) }}</span>
                        @endif
                    </a>
                    <select name="sorting" id="sortingOption" class="w-auto shadow-sm form-select" style="border-color: #8B4513; background-color: #fff;">
                        <option value="">Sort By</option>
                        <option value="asc">Price: Low to High</option>
                        <option value="desc">Price: High to Low</option>
                    </select>
                </div>
                <div class="row" id="product-list">
                    @if(count($pizzaData) != 0)
                    @foreach ($pizzaData as $pizza)
                    <div class="mb-4 col-lg-4 col-md-6">
                        <div class="border-0 shadow-sm card h-100 coffee-card position-relative" data-description="{{ Str::limit($pizza['description'], 100) }}">
                            <img class="card-img-top" src="{{ asset('storage/' . $pizza['image']) }}" alt="{{ $pizza['name'] }}" style="height: 200px; object-fit: cover;">
                            <div class="text-center card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold" style="color: #8B4513;">{{ $pizza['name'] }}</h5>
                                <p class="text-muted flex-grow-1">{{ Str::limit($pizza['description'], 50) }}</p>
                                <h5 class="text-danger">{{ number_format($pizza['price'], 0) }} Kyats</h5>
                                <div class="gap-2 mt-2 d-flex justify-content-center">
                                    <a href="{{ route('user.blogs.seeMore', $pizza['product_id']) }}" class="btn btn-sm" style="background-color: #D2B48C; color: #fff; border: none;">Details</a>
                                    <a href="{{ route('user.pizza.detail', $pizza['product_id']) }}" class="btn btn-sm" style="background-color: #8B4513; color: #fff; border: none;">Add to Cart</a>
                                </div>
                            </div>
                            <!-- Hover Description Overlay -->
                            <div class="top-0 p-3 text-center text-white bg-opacity-75 card-description-overlay position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark" style="z-index: 1;">
                                <p class="mb-0 fs-6">{{ Str::limit($pizza['description'], 100) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-center w-100 fw-semibold" style="color: #8B4513;">No items available.</p>
                    @endif
                </div>
                @if(count($pizzaData) != 0)
                <div class="mt-4 d-flex justify-content-center">
                    {{ $pizzaData->links() }}
                </div>
                @endif
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>

<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #f5e8d8;">
            <div class="modal-header" style="border-bottom: 2px solid #8B4513;">
                <h5 class="modal-title fw-bold" id="receiptModalLabel" style="color: #8B4513;">Order Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="receiptContent">
                    <h5 id="orderCode" style="color: #8B4513;"></h5>
                    <p id="orderDate" class="text-muted"></p>
                    <table class="table table-striped" style="background-color: #fff;">
                        <thead style="background-color: #D2B48C; color: #fff;">
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="orderItems"></tbody>
                    </table>
                    <div class="text-center">
                        <h5 id="totalPrice" style="color: #8B4513;"></h5>
                        <p id="paymentMethod" class="text-muted"></p>
                        <img id="paymentQR" src="" width="200" alt="Payment QR Code" class="rounded shadow-sm">
                        <p class="text-muted">Scan to complete payment</p>
                        <button id="qrHasScanned" class="mt-3 shadow-sm btn fw-bold" style="background-color: #8B4513; color: #fff; border: none; padding: 12px 20px; border-radius: 10px; transition: background-color 0.3s;">
                            ✅ I have made the payment
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between" style="border-top: 2px solid #8B4513;">
                <button id="prevReceipt" class="shadow-sm btn btn-outline-secondary">Previous</button>
                <button id="nextReceipt" class="shadow-sm btn" style="background-color: #D2B48C; color: #fff; border: none;">Next</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script>
    $(document).ready(function () {
        // Card hover effect
        $('.coffee-card').each(function () {
            const overlay = $(this).find('.card-description-overlay');
            $(this).on('mouseenter', () => {
                gsap.to(overlay, { opacity: 1, y: 0, duration: 0.3, ease: 'power2.out' });
            }).on('mouseleave', () => {
                gsap.to(overlay, { opacity: 0, y: 20, duration: 0.3, ease: 'power2.in' });
            });
        });

        // Button hover effect
        $('#qrHasScanned').hover(
            function() { $(this).css('background-color', '#A0522D'); },
            function() { $(this).css('background-color', '#8B4513'); }
        );

        // Sorting AJAX
        $('#sortingOption').change(function() {
            const eventOption = $(this).val();
            const url = 'http://127.0.0.1:8000/ajax/pizzaList';
            const storageUrl = '{{ asset('storage') }}';
            if (eventOption) {
                $.ajax({
                    type: 'get',
                    url: url,
                    dataType: 'json',
                    data: { status: eventOption },
                    success: function(response) {
                        let list = '';
                        response.forEach((pizza) => {
                            list += `
                            <div class="mb-4 col-lg-4 col-md-6">
                                <div class="border-0 shadow-sm card h-100 coffee-card position-relative" data-description="${pizza.description.substring(0, 100)}">
                                    <img class="card-img-top" src="${storageUrl}/${pizza.image}" alt="${pizza.name}" style="height: 200px; object-fit: cover;">
                                    <div class="text-center card-body d-flex flex-column">
                                        <h5 class="card-title fw-semibold" style="color: #8B4513;">${pizza.name}</h5>
                                        <p class="text-muted flex-grow-1">${pizza.description.substring(0, 50)}</p>
                                        <h5 class="text-danger">${Number(pizza.price).toLocaleString()} Kyats</h5>
                                        <div class="gap-2 mt-2 d-flex justify-content-center">
                                            <a href="{{ route('user.pizza.detail', '') }}/${pizza.product_id}" class="btn btn-sm" style="background-color: #D2B48C; color: #fff; border: none;">Details</a>
                                            <a href="{{ route('user.cartList') }}" class="btn btn-sm" style="background-color: #8B4513; color: #fff; border: none;">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="top-0 p-3 text-center text-white bg-opacity-75 card-description-overlay position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark" style="z-index: 1;">
                                        <p class="mb-0 fs-6">${pizza.description.substring(0, 100)}</p>
                                    </div>
                                </div>
                            </div>`;
                        });
                        $('#product-list').html(list);
                    }
                });
            }
        });

        // Receipt Modal Logic
        let receipts = @json($confirmedOrdersForUser->groupBy('order_code'));
        let receiptKeys = Object.keys(receipts);
        let currentReceiptIndex = 0;
        let paidOrders = JSON.parse(localStorage.getItem('paidOrders') || '[]'); // Store paid order IDs locally

        function updateReceipt(index) {
            if (index < 0 || index >= receiptKeys.length) return;
            currentReceiptIndex = index;
            let orderCode = receiptKeys[index];
            let orders = receipts[orderCode];

            // Check if this order has been paid
            let orderListId = orders[0].id;
            if (paidOrders.includes(orderListId)) {
                // Skip to next unpaid receipt if available
                let nextUnpaidIndex = receiptKeys.findIndex((key, i) => i > index && !paidOrders.includes(receipts[key][0].id));
                if (nextUnpaidIndex !== -1) {
                    updateReceipt(nextUnpaidIndex);
                } else {
                    $('#receiptModal').modal('hide');
                }
                return;
            }

            $('#orderCode').text(`Order Code: ${orderCode}`);
            $('#orderDate').text(`Order Date: ${orders[0].created_at}`);
            let orderItemsHTML = '';
            let totalAmount = 0;
            let uniquePaymentMethods = [...new Set(orders.map(order => order.payment_method))];

            orders.forEach(order => {
                totalAmount += order.total;
                orderItemsHTML += `
                <tr>
                    <td>${order.product_name ?? 'N/A'}</td>
                    <td>${order.qty}</td>
                    <td>${order.total.toLocaleString()} Kyats</td>
                    <input type="hidden" name="orderListId" class="orderListId" value="${order.id}">
                </tr>`;
            });

            $('#orderItems').html(orderItemsHTML);
            $('#totalPrice').text(`Total Price: ${totalAmount.toLocaleString()} Kyats`);
            $('#paymentMethod').text(uniquePaymentMethods.length === 1 ? `Payment Method: ${uniquePaymentMethods[0].replace('_payment', '').toUpperCase()}` : 'Multiple Payment Methods');

            let qrCodePath = {
                'kbz_payment': '{{ asset("storage/images/kbz_qr.jpg") }}',
                'aya_payment': '{{ asset("storage/images/aya_qr.jpg") }}',
                'a+_payment': '{{ asset("storage/images/aPlus_qr.jpg") }}'
            };
            $('#paymentQR').attr('src', uniquePaymentMethods.length === 1 ? qrCodePath[uniquePaymentMethods[0]] || '' : '');

            $('#prevReceipt').prop('disabled', index === 0);
            $('#nextReceipt').prop('disabled', index === receiptKeys.length - 1);
            $('#receiptModal').modal('show');
        }

        $('#prevReceipt').click(() => updateReceipt(currentReceiptIndex - 1));
        $('#nextReceipt').click(() => updateReceipt(currentReceiptIndex + 1));

        // Only show modal if there are unpaid receipts
        let firstUnpaidIndex = receiptKeys.findIndex(key => !paidOrders.includes(receipts[key][0].id));
        if (firstUnpaidIndex !== -1) {
            updateReceipt(firstUnpaidIndex);
        }

        // QR Scanned AJAX
        $('#qrHasScanned').off('click').on('click', function(e) {
            e.preventDefault();
            let $button = $(this);
            if ($button.prop('disabled')) return; // Prevent multiple clicks

            $button.prop('disabled', true); // Disable button immediately
            let url = "{{ route('ajax.qrHasBeenScanned') }}";
            let orderListId = $('.orderListId').first().val();

            $.ajax({
                url: url,
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ orderListId: orderListId }),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    alert("Order has been made successfully.");
                    paidOrders.push(orderListId); // Add to paid orders
                    localStorage.setItem('paidOrders', JSON.stringify(paidOrders)); // Persist in localStorage
                    $('#receiptModal').modal('hide'); // Hide modal immediately
                    // Move to next unpaid receipt or close if none remain
                    let nextUnpaidIndex = receiptKeys.findIndex((key, i) => i > currentReceiptIndex && !paidOrders.includes(receipts[key][0].id));
                    if (nextUnpaidIndex !== -1) {
                        updateReceipt(nextUnpaidIndex);
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert("An error occurred while processing the order. Please try again.");
                    $button.prop('disabled', false); // Re-enable on error
                }
            });
        });
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@endsection

<style>
    .hover-link:hover {
        color: #8B4513;
        text-decoration: underline;
    }
    .btn:hover {
        opacity: 0.9;
    }
    .pagination .page-link {
        color: #8B4513;
        border-color: #D2B48C;
    }
    .pagination .page-item.active .page-link {
        background-color: #8B4513;
        border-color: #8B4513;
        color: #fff;
    }
</style>

@extends('user.layouts.master')

@section('container')
<!-- Go Back Button -->
<div class="container-fluid py-3" style="background-color: #f5e8d8;">
    <div class="row px-xl-5">
        <div class="col-12 ">
            <a href="{{ route('user.orderMenu') }}" class="btn btn-custom-back" style="background-color: #3d2b23; color: #f5e8d8; border-radius: 25px; padding: 10px 25px; font-family: 'Poppins', sans-serif; font-size: 16px; text-decoration: none; transition: 0.3s ease-in-out; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);"
               onmouseover="this.style.backgroundColor='#523C31'; this.style.color='#f5e8d8';"
               onmouseout="this.style.backgroundColor='#3d2b23'; this.style.color='#f5e8d8';">
                Go Back
            </a>
        </div>
    </div>
</div>

<div class="container-fluid py-2" style="background-color: #f5e8d8;">
    <div class="row px-xl-5">
        <div class="mb-5 col-lg-8 mx-auto table-responsive">
            <table class="table mb-0 text-center table-light table-borderless table-hover" id="dataTable" style="background-color: #fff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                <thead class="thead-dark" style="background-color: #3d2b23; color: #f5e8d8;">
                    <tr>
                        <th>#</th>
                        <th>Order Code</th>
                        <th>Total</th>
                        <th>Quantity</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php
                        $groupedOrders = $orderList->groupBy('order_code');
                        $counter = 1;
                    @endphp

                    @foreach ($groupedOrders as $orderCode => $orders)
                        <tr>
                            <td colspan="6" class="bg-light font-weight-bold" style="background-color: #ede0d4; font-family: 'Playfair Display', serif; font-size: 18px; padding: 15px;">
                                Order Code: {{ $orderCode }}
                            </td>
                        </tr>

                        @foreach ($orders as $order)
                            <tr>
                                <td style="color: #3d2b23; font-family: 'Poppins', sans-serif;">{{ $counter++ }}</td>
                                <td style="color: #3d2b23; font-family: 'Poppins', sans-serif;">{{ $order->order_code }}</td>
                                <td style="color: #3d2b23; font-family: 'Poppins', sans-serif;">${{ number_format($order->total, 2) }}</td>
                                <td style="color: #3d2b23; font-family: 'Poppins', sans-serif;">{{ $order->qty }}</td>
                                <td class="{{ $order->status === 'Rejected' ? 'text-danger' : ($order->status === 'Confirmed' ? 'text-success' : 'text-warning') }}"
                                    style="font-family: 'Poppins', sans-serif;">
                                    {{ $order->status }}
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" style="background-color: #d35400; border-color: #d35400; transition: 0.3s ease-in-out;"
                                            onmouseover="this.style.backgroundColor='#b84500'; this.style.borderColor='#b84500';"
                                            onmouseout="this.style.backgroundColor='#d35400'; this.style.borderColor='#d35400';"
                                            onclick="showOrderDetails('{{ $order->order_code }}', '{{ $order->status }}')">
                                        Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
            <div class="modal-header text-white" style="border-bottom: none; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title" id="statusModalLabel" style="font-family: 'Playfair Display', serif; font-size: 24px;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body text-center" style="font-family: 'Poppins', sans-serif; font-size: 16px; padding: 20px;"></div>
            <div class="modal-footer" style="border-top: none; justify-content: center;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #3d2b23; color: #3d2b23; transition: 0.3s ease-in-out;"
                        onmouseover="this.style.backgroundColor='#3d2b23'; this.style.color='#f5e8d8';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#3d2b23';">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showOrderDetails(orderCode, status) {
        var modalMessage = '';
        var modalTitle = '';
        var modalClass = '';

        if (status === 'Rejected') {
            modalMessage = 'Your order ' + orderCode + ' has been rejected due to insufficient stock.';
            modalTitle = 'Order Rejected';
            modalClass = 'bg-danger';
        } else if (status === 'Confirmed') {
            modalMessage = 'Congratulations! Your order ' + orderCode + ' has been confirmed.';
            modalTitle = 'Order Confirmed';
            modalClass = 'bg-success';
        } else {
            modalMessage = 'Your order ' + orderCode + ' is still being processed.';
            modalTitle = 'Order Pending';
            modalClass = 'bg-warning';
        }

        var modal = new bootstrap.Modal(document.getElementById('statusModal'));
        document.getElementById('statusModalLabel').innerText = modalTitle;
        document.querySelector('.modal-header').className = 'modal-header text-white ' + modalClass;
        document.querySelector('.modal-body').innerText = modalMessage;
        modal.show();
    }
</script>
@endsection

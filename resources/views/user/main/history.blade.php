@extends('user.layouts.master')
@section('container')

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="mb-5 col-lg-8 table-responsive">
            <table class="table mb-0 text-center table-light table-borderless table-hover" id="dataTable">
                <thead class="thead-dark">
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
                            <td colspan="6" class="bg-light font-weight-bold">
                                Order Code: {{ $orderCode }}
                            </td>
                        </tr>

                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>{{ $order->qty }}</td>
                                <td class="{{ $order->status === 'Rejected' ? 'text-danger' : ($order->status === 'Confirmed' ? 'text-success' : '') }}">
                                    {{ $order->status }}
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="showOrderDetails('{{ $order->order_code }}', '{{ $order->status }}')">
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
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="statusModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="text-center modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
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
<p>hello worl</p>
@endsection
//this is testing whether the codes have been altered or not t

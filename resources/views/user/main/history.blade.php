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
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php
                        $groupedOrders = $orderList->groupBy('order_code');
                        $counter = 1;
                    @endphp

                    @foreach ($groupedOrders as $orderCode => $orders)
                        <!-- Display the order code as a header row -->
                        <tr>
                            <td colspan="5" class="bg-light font-weight-bold">
                                Order Code: {{ $orderCode }}
                            </td>
                        </tr>

                        <!-- Display individual orders under this order code -->
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>{{ $order->qty }}</td>
                                <td class="{{ $order->status === 'Rejected' ? 'text-danger' : ($order->status === 'Confirmed' ? 'text-success' : '') }}">
                                    {{ $order->status }}
                                </td>
                            </tr>

                            <!-- Trigger Modal on Page Load -->
                            @if ($order->status === 'Rejected' || $order->status === 'Confirmed')
                                <script>
                                    {{--  window.addEventListener('load', function() {
                                        var modal = new bootstrap.Modal(document.getElementById('statusModal'));
                                        modal.show();
                                    });  --}}
                                    window.addEventListener('load', function () {
                                        var modal = new bootstrap.Modal(document.getElementById('statusModal'));
                                        modal.show();

                                        document.getElementById('statusModal').addEventListener('hidden.bs.modal', function () {
                                            document.body.classList.remove('modal-open');  // Remove Bootstrap modal class
                                            document.querySelector('.modal-backdrop')?.remove();  // Remove the backdrop manually
                                        });
                                    });

                                </script>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header
                {{ isset($order) && $order->status === 'Rejected' ? 'bg-danger' : 'bg-success' }}
                text-white">
                <h5 class="modal-title" id="statusModalLabel">
                    {{ isset($order) && $order->status === 'Rejected' ? 'Order Rejected' : 'Order Confirmed' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="text-center modal-body">
                {{ isset($order) && $order->status === 'Rejected'
                    ? 'Your order has been rejected due to insufficient stock.'
                    : 'Congratulations! Your order has been confirmed.'
                }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

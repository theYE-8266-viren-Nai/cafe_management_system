@extends('admin.layouts.master')
@section('title','orderList')
@section('content')
<div class="container mt-4">
    {{-- Include alerts --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('update_password'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('update_password') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('delSuccess'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('delSuccess') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Table --}}
    <div class="table-responsive table-responsive-data2">
        <table class="table table-bordered">
            <thead class="table-dark">
                <th>
                    <th>Order Code</th>
                    <th>User Name</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Status</th>
                    <th>stock</th>
                </th>
            </thead>
            <tbody>
                @if (count($orderList) != 0)
                    @php
                        $lastOrderCode = null;
                    @endphp
                    @foreach($orderList as $order)
                        @if ($order->order_code !== $lastOrderCode)
                            {{-- Display the order code once per group --}}
                            <tr>
                                <td colspan="6" class="bg-light">
                                    <form action="{{ route('admin.order.updateStatus') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <strong>Order Code: {{ $order->order_code }}</strong>
                                        <select name="status" class="w-auto ml-3 form-select d-inline">
                                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Confirm</option>
                                            <option value="-1" {{ $order->status == -1 ? 'selected' : '' }}>Reject</option>
                                        </select>
                                        <input type="hidden" name="order_code" value="{{ $order->order_code }}">
                                        <button type="submit" class="ml-2 btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $lastOrderCode = $order->order_code;
                            @endphp
                        @endif

                        {{-- Order Details --}}
                        <tr class="tr-shadow">
                            <td></td> <!-- Empty column since order code is displayed as a header -->
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>{{ $order->status == 0 ? 'Pending' : 'Confirmed' }}</td>
                            <td>{{ $order->stock }}</td>
                        </tr>

                        {{-- Warning Message if Stock is Not Enough --}}
                        @if ($order->stock < $order->qty)
                            <tr>
                                <td colspan="7" class="text-center text-danger">
                                    <strong>⚠ Warning: Stock is not enough for {{ $order->product_name }}!</strong>
                                </td>
                            </tr>
                        @endif

                        <tr class="spacer"></tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">
                            <h5>There is no order list here</h5>
                        </td>
                    </tr>
                @endif
            </tbody>


        </table>

        {{-- Pagination (if applicable) --}}
        <div class="mt-3">
            {{-- {{ $orderList->links() }} --}}
        </div>
    </div>
</div>


@endsection

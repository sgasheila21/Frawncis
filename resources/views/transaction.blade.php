@extends('template/layout-two')

@section('title', 'Transaction')
@section('sub-content')
<div class="table-responsive p-3">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">City</th>
            <th scope="col">TransactionDate</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">SubTotal</th>
            </tr>
        </thead>
            @foreach($transactions->groupBy('transaction_date') as $transactionDate => $transactions)
                @foreach($transactions->groupBy('member_id') as $customerId => $customerTransactions)
                    @foreach($customerTransactions->groupBy('pickup_status') as $transPickUp => $trans)
                        @php
                            $total_price = 0;
                        @endphp
                        <tbody>
                            @foreach($trans as $transaction)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $transaction->members->fullname }}</td>
                                    <td>{{ $transaction->locations->city }}</td>
                                    <td>{{ $transaction->transaction_date }}</td>
                                    <td>{{ $transaction->products->name }}</td>
                                    <td>{{ $transaction->products->price }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>{{ $transaction->products->price * $transaction->quantity }}</td>
                                </tr>
                                @php
                                    $total_price += ($transaction->products->price * $transaction->quantity);
                                @endphp
                            @endforeach
                        </tbody>
                        <tr>
                            <td></td>
                            <td colspan="3">Total Price : Rp{{ $total_price }}</td>
                            @if($transPickUp == 0)
                            <td colspan="1">Pickup Status : Not Picked Up</td>
                            <td colspan="3" class="text-center">
                                <form action="{{ route('update.pickup.status') }}" method="POST">
                                    @csrf
                                    <b>Set Pickup Status</b>
                                    @foreach($trans as $transaction)
                                        <input name="transItems[]" value="{{ $transaction->id }}" hidden>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary ms-3">Picked Up</button>
                                </form>
                            </td>
                            @elseif($transPickUp == 1)
                            <td colspan="1">Pickup Status : Picked Up</td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
    </table>
</div>  
@endsection
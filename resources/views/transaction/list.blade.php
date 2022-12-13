@extends('layouts.app')
@section('content')

    <table class="table table-bordered">

        <thead>

        <tr>

            <th>From User</th>
            <th>To User</th>
            <th>Amount</th>
            <th>Attachments</th>
            <th>Status</th>
            <th width="300px;">Action</th>

        </tr>

        </thead>

        <tbody>

        @if(!empty($transactions) && $transactions->count())

            @foreach($transactions as $key => $transaction)

                <tr>
                    <td>{{ $transaction->fromUser->name }}</td>
                    <td>{{ $transaction->toUser->name }}</td>
                    <td>{{ number_format($transaction->amount,2) }}</td>
                    <td>
                        @foreach($transaction->attachments as $attachment)
                            <a href="{{route("transaction-attachment-download",$attachment->id)}}">{{$attachment->original_name}}</a>
                            <br>
                        @endforeach
                    </td>
                    <td><span class="text">{{ $transaction->status }}</span></td>
                    @if($transaction->status == \App\Models\Transaction::STATUS_CONFIRMED)
                        <td>
                            @include("transaction.reject")
                        </td>
                    @elseif($transaction->status == \App\Models\Transaction::STATUS_REJECTED)
                        <td>
                            @include("transaction.confirm")
                        </td>
                    @else
                        <td>
                            @include("transaction.confirm")
                            @include("transaction.reject")
                        </td>
                    @endif

                </tr>
            @endforeach

        @else

            <tr>

                <td colspan="10">There are no data.</td>

            </tr>

        @endif

        </tbody>

    </table>


    {!! $transactions->links('pagination::bootstrap-5') !!}

@endsection

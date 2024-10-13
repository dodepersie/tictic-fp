@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'All Transactions'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>All Transactions</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Event Title</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Qty</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $transaction->product->event_title }}
                                                    ({{ $transaction->unique_id }})</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">UNDER
                                                    DEVELOPMENT</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">Rp
                                                    {{ number_format($transaction->price, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($transaction->status == 'Success')
                                                    <span
                                                        class="badge bg-success text-xs font-weight-bold">{{ $transaction->status }}</span>
                                                @elseif($transaction->status == 'Pending')
                                                    <span
                                                        class="badge bg-warning text-xs font-weight-bold">{{ $transaction->status }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-danger text-xs font-weight-bold">{{ $transaction->status }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($transaction->status == 'Pending')
                                                    <a href="{{ route('checkout', $transaction->id) }}" target="_blank"
                                                        class="badge bg-primary text-bg-primary text-xs font-weight-bold">Pay
                                                        Now</a>
                                                @elseif ($transaction->status == 'Success')
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <a href="{{ route('checkout', $transaction->id) }}" target="_blank"
                                                            class="badge bg-primary text-bg-primary text-xs font-weight-bold">View
                                                            Ticket</a>
                                                        <a href="{{ route('checkout', $transaction->id) }}" target="_blank"
                                                            class="badge bg-secondary text-bg-secondary text-xs font-weight-bold">Review</a>
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-sm">No data available..</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

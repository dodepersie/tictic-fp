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
                            <table class="table table-hover" id="transactions_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            #</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Event Title</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Qty</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Price</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-sm font-weight-bold">{{ $transaction->product->event_title }}
                                                    {{ $transaction->ticketType->type }}
                                                    ({{ $transaction->unique_id }})
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-sm font-weight-bold">{{ $transaction->quantity }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-bold">Rp
                                                    {{ number_format($transaction->price, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($transaction->status == 'Success')
                                                    <span
                                                        class="badge text-sm bg-gradient-success font-weight-bold">{{ $transaction->status }}</span>
                                                @elseif($transaction->status == 'Pending')
                                                    <span
                                                        class="badge text-sm bg-gradient-warning font-weight-bold">{{ $transaction->status }}</span>
                                                @else
                                                    <span
                                                        class="badge text-sm bg-gradient-danger font-weight-bold">{{ $transaction->status }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($transaction->status == 'Pending')
                                                    <a href="{{ route('checkout', $transaction->id) }}" target="_blank"
                                                        class="badge bg-primary text-bg-primary text-sm font-weight-bold">Pay
                                                        Now</a>
                                                @elseif ($transaction->status == 'Success')
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <form action="{{ route('view-ticket-detail') }}" method="POST">
                                                            <!--Bug -->
                                                            @csrf
                                                            <input type="hidden" name="unique_id"
                                                                value="{{ $transaction->unique_id }}" />
                                                            <button type="submit"
                                                                class="badge bg-primary text-bg-primary text-sm font-weight-bold border-0">View
                                                                Ticket</button>
                                                        </form>
                                                        <a href="{{ route('dashboard_transactions.index.review', $transaction->id) }}"
                                                            class="badge bg-secondary text-bg-secondary text-sm font-weight-bold">Review</a>
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

@push('script')
    <script>
        $(document).ready(function() {
            $('#transactions_table').DataTable({
                scrollX: true,
                scrollCollapse: true,
                responsive: true,
                language: {
                    search: "Search in table:"
                },
                ordering: false
            });
        });
    </script>
@endpush

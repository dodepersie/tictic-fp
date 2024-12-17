@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Analytic Report of: ' . $product->event_title])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Analytic Report of: {{ $product->event_title }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="container mt-5">
                            <h4 class="mb-4">Statistik Penjualan</h4>
                            <canvas id="salesChart" width="400" height="200"></canvas>
                        </div>

                        <div class="mb-4">
                            <p><strong>Total Tickets:</strong> {{ $totalTickets }}</p>
                            <p><strong>Remaining Tickets:</strong> {{ $remainingTickets }}</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col"
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Type</th>
                                        <th scope="col"
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Available Tickets</th>
                                        <th scope="col"
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Remaining Tickets</th>
                                        <th scope="col"
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticketDetails as $ticket)
                                        <tr>
                                            <td class="align-middle text-center">{{ $ticket['type'] }}</td>
                                            <td class="align-middle text-center">{{ $ticket['available'] }}</td>
                                            <td class="align-middle text-center">{{ $ticket['remaining'] }}</td>
                                            <td class="align-middle text-center">
                                                IDR <span
                                                    class="fw-bold">{{ number_format($ticket['price'], 0, ',', '.') }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <a href="javascript:window.history.back()" class="btn btn-primary btn-sm ms-auto mt-3">Back</a>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

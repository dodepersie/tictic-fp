@php
    $ticketTypes = $ticketDetails->pluck('type')->toArray();
    $soldQuantities = $ticketDetails->pluck('sold_quantity')->toArray();
@endphp

@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Analytic Report of: ' . ucfirst($product->event_title),
    ])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Analytic Report of: {{ ucfirst($product->event_title) }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p><strong>Total Tickets:</strong> {{ $totalTickets }}</p>
                            <p><strong>Remaining Tickets:</strong> {{ $remainingTickets }}</p>
                        </div>

                        <div style="position: relative; width: 100%; height: 300px; max-width: 600px;">
                            <canvas id="sales_chart"></canvas>
                        </div>

                        <div class="table-responsive mt-3">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('sales_chart').getContext('2d');

            const data = {
                labels: @json($ticketTypes),
                datasets: [{
                    label: 'Tickets Sold',
                    data: @json(collect($ticketDetails)->pluck('sold_quantity')->map(fn($qty) => $qty ?? 0)),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Ticket Sales Report'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Sold Quantity'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Ticket Types'
                            }
                        }
                    }
                }
            };

            const lineChart = new Chart(ctx, config);
        });
    </script>
@endpush

@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            @can('admin')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Event Tickets</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $total_event_tickets }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle text-white">
                                        <i data-feather="tag" style="margin-top: 14px;margin-left: 2px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Merchants</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $total_merchants }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle text-white">
                                        <i data-feather="users" style="margin-top: 10px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Users</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $total_users }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle text-white">
                                        <i data-feather="users" style="margin-top: 10px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pending Merchants</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $total_pending_merchants }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle text-white">
                                        <i data-feather="clock" style="margin-top: 12px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('merchant')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Your Event Tickets</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $total_merchant_events }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle text-white">
                                        <i data-feather="tag" style="margin-top: 14px;margin-left: 2px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Active Event</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $total_active_event }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle text-white">
                                        <i data-feather="users" style="margin-top: 10px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Tickets Sold</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $total_ticket_sold }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle text-white">
                                        <i data-feather="users" style="margin-top: 10px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Revenue This Month</p>
                                        <h5 class="font-weight-bolder">
                                            <!-- Here -->
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle text-white">
                                        <i data-feather="clock" style="margin-top: 12px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('customer')
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Balance</p>
                                        <h5 class="font-weight-bolder">
                                            IDR {{ $total_merchant_events }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-secondary shadow-secondary text-center rounded-circle text-white">
                                        <i data-feather="dollar-sign" style="margin-top: 12px;margin-left: 1px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Your Ordered Tickets</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $ordered_tickets }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle text-white">
                                        <i data-feather="tag" style="margin-top: 14px;margin-left: 2px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Your Active Ticket</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $active_tickets->count() }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle text-white">
                                        <i data-feather="activity" style="margin-top: 14px;margin-left: 2px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
        @can('admin')
            <div class="row mt-4">
                <div class="col-lg-7 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">Event created chart</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span> in 2024
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card overflow-hidden h-100 p-0">
                        <div class="card-header pb-0 p-3">
                            <h6 class="text-capitalize mb-2">Top event sold</h6>
                        </div>
                        <div class="card-body p-3">
                            Halo isi disini ya..
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-7 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <h6 class="text-capitalize mb-2">Customer registration chart</h6>
                        </div>
                        <div class="card-body p-3">
                            Halo isi disini ya..
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Categories</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-mobile-button text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                            <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                                                    sold</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-tag text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                            <span class="text-xs">123 closed, <span class="font-weight-bold">15
                                                    open</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-box-2 text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                            <span class="text-xs">1 is active, <span class="font-weight-bold">40
                                                    closed</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                                            <span class="text-xs font-weight-bold">+ 430</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('customer')
            <div class="row mt-0 mt-lg-4">
                {{-- Upcoming Tickets --}}
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="card overflow-hidden h-100 p-0">
                        <div class="card-header pb-0 p-3 d-flex align-items-center gap-2">
                            <i data-feather="bell" style="margin-left: 2px; margin-top: -7px;"></i>
                            <h6 class="text-capitalize fs-6">Upcoming Event in 7 Days</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive p-0">
                                <table class="table table-hover" style="width: 100%;">
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
                                                Event Start Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($upcoming_tickets->take(5) as $upcoming_ticket)
                                            <tr>
                                                <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-sm font-weight-bold">{{ ucfirst($upcoming_ticket->product->event_title) }}
                                                        {{ $upcoming_ticket->ticketType->type }}
                                                        ({{ $upcoming_ticket->unique_id }})
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ \Carbon\Carbon::parse($upcoming_ticket->product->event_start_date)->format('d F Y') }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a href="{{ route('view-ticket-detail', ['id' => $upcoming_ticket->unique_id]) }}"
                                                        class="badge bg-primary text-bg-primary text-xs font-weight-bold border-0">Check</a>

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

                {{-- Active Tickets --}}
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="card overflow-hidden h-100 p-0">
                        <div class="card-header pb-0 p-3 d-flex align-items-center gap-2">
                            <i data-feather="zap" style="margin-left: 2px; margin-top: -7px;"></i>
                            <h6 class="text-capitalize fs-6">Active Tickets</h6>
                        </div>
                        <div class="card-body p-3 pt-0">
                            <div class="table-responsive p-0">
                                <table class="table table-hover" style="width: 100%;">
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
                                                Event Start Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($active_tickets->take(5) as $active_ticket)
                                            <tr>
                                                <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-sm font-weight-bold">{{ ucfirst($active_ticket->product->event_title) }}
                                                        {{ $active_ticket->ticketType->type }}
                                                        ({{ $active_ticket->unique_id }})
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ \Carbon\Carbon::parse($active_ticket->product->event_start_date)->format('d F Y') }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a href="{{ route('view-ticket-detail', ['id' => $active_ticket->unique_id]) }}"
                                                        class="badge bg-primary text-bg-primary text-xs font-weight-bold border-0">Check</a>
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
        @endcan
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('script')
    <script src="./assets/js/plugins/chartjs.min.js"></script>

    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush

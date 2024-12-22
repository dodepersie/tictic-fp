@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Analytics Report'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>View Analytics Report</h6>
                    </div>
                    <div class="card-body">
                        @can('admin')
                            <table class="table table-hover" id="merchants_table" style="width: 100%;">
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
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($merchants as $merchant)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-sm font-weight-bold">{{ $merchant->user->name }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('dashboard_analytics.admin_report', $merchant->id) }}"
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
                        @endcan

                        @can('merchant')
                            <table class="table table-hover" id="events_table" style="width: 100%;">
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
                                    @forelse ($products as $product)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-sm font-weight-bold">{{ ucfirst($product->event_title) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($product->event_start_date)->format('d F Y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('dashboard_analytics.report', $product->id) }}"
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
                        @endcan
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
            $('#merchants_table').DataTable({
                scrollX: true,
                scrollCollapse: true,
                responsive: true,
                ordering: false,
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#events_table').DataTable({
                scrollX: true,
                scrollCollapse: true,
                responsive: true,
                ordering: false,
            });
        });
    </script>
@endpush

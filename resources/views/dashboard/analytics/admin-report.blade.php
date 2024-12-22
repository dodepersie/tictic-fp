@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => $title,
    ])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>{{ $title }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="events_table" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col"
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            #</th>
                                        <th scope="col"
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Event Title</th>
                                        <th scope="col"
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Event Start Date</th>
                                        <th scope="col"
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
                                                <a href="{{ route('dashboard_analytics.admin_report_data', ['merchantId' => $merchant->id, 'productId' => $product->id]) }}"
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
                        <a href="javascript:window.history.back()" class="btn btn-primary btn-sm ms-auto mt-3">Back</a>
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
            $('#events_table').DataTable({
                scrollX: true,
                scrollCollapse: true,
                responsive: true,
                ordering: false,
            });
        });
    </script>
@endpush

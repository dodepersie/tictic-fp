@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'All Categories'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>All Categories</h6>
                            <a href="{{ route('dashboard_categories.create') }}"
                                class="btn btn-secondary btn-sm ms-auto">Create new category</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover" id="categories_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            #</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Category Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td scope="row" class="px-4 text-sm text-center">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-sm font-weight-bold">{{ $category->name }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <form action="{{ route('dashboard_categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <a href="{{ route('dashboard_categories.destroy', $category->id) }}"
                                                        class="btn btn-danger btn-xs" data-confirm-delete="true"><i
                                                            data-feather="trash" style="width: 20px; height: 20px;"
                                                            aria-hidden="true"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-sm">No data available..</td>
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
            $('#categories_table').DataTable({
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

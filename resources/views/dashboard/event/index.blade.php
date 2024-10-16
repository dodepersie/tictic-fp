@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Merchants'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>Your Events</h6>
                            <a href="{{ route('merchant_events.create') }}" class="btn btn-secondary btn-sm ms-auto">Create
                                event</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
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
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-sm font-weight-bold">{{ $event->event_title }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div
                                                    style="display: flex; justify-content: center; align-items: center; gap: 7px">
                                                    <a href="{{ route('event.show', $event->slug) }}"
                                                        class="btn bg-primary text-white btn-xs">
                                                        <i data-feather="eye" style="width: 20px; height: 20px;"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('merchant_events.edit', $event->id) }}"
                                                        class="btn btn-success btn-xs">
                                                        <i data-feather="edit" style="width: 20px; height: 20px;"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                    <form action="{{ route('merchant_events.destroy', $event->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('merchant_events.destroy', $event->id) }}"
                                                            class="btn btn-danger btn-xs delete-event"
                                                            data-confirm-delete="true">
                                                            <i data-feather="trash-2" style="width: 20px; height: 20px;"
                                                                aria-hidden="true"></i>
                                                        </a>
                                                    </form>
                                                </div>
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
            $('#events_table').DataTable({
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

@push('swal_delete')
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.delete_event', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var button = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will delete this event..",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes, I\'m sure',
                    showClass: {
                        popup: 'animate__animated animate__bounceIn'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__bounceOut'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Selected event deleted successfully!',
                            'success'
                        ).then(() => {
                            button.closest('form')
                                .submit();
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Canceled',
                            'Selected event not deleted :)',
                            'error'
                        )
                    }
                });
            });
        });
    </script>
@endpush

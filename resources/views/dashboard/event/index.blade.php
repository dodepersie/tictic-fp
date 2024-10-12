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
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Event Title</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                        <tr>
                                            <td scope="row" class="px-4 text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-sm">
                                                <span
                                                    class="text-secondary text-sm font-weight-bold">{{ $event->event_title }}</span>
                                            </td>
                                            <td class="align-middle" style="height: 100px;">
                                                <div
                                                    style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                                    <a href="{{ route('merchant_events.edit', $event->id) }}" method="POST"
                                                        class="btn btn-success btn-xs" style="margin-right: 5px;">
                                                        <i data-feather="edit" style="width: 20px; height: 20px;"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                    <form action="{{ route('merchant_events.destroy', $event->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                                data-feather="trash-2" style="width: 20px; height: 20px;"
                                                                aria-hidden="true"></i></button>
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

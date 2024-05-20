@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Merchants'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Pending Merchants</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phone Number</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Registration Document</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pending_merchants as $pending_merchant)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $pending_merchant->user->profile_picture ?? asset('assets/img/noprofile.webp') }}"
                                                            class="avatar avatar-sm me-3"
                                                            alt="{{ $pending_merchant->user->name }}">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $pending_merchant->user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $pending_merchant->user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $pending_merchant->user->phone_number ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if ($pending_merchant->merchant_document)
                                                        <a
                                                            href="/storage/document/{{ $pending_merchant->merchant_document }}">
                                                            <i data-feather="file-text"
                                                                style="width: 14px; height: 14px;"></i>
                                                            {{ $pending_merchant->merchant_document }}
                                                        </a>
                                                    @else
                                                        No data..
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle" style="height: 100px;">
                                                <div
                                                    style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                                    <form action="{{ route('merchant.approve', $pending_merchant->id) }}"
                                                        method="POST" style="margin-right: 5px;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-xs">
                                                            <i data-feather="check" style="width: 20px; height: 20px;"
                                                                aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('merchant.reject', $pending_merchant->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                                data-feather="x" style="width: 20px; height: 20px;"
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

            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>All Merchants</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phone Number</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($merchants as $merchant)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $merchant->user->profile_picture ?? asset('assets/img/noprofile.webp') }}"
                                                            class="avatar avatar-sm me-3"
                                                            alt="{{ $merchant->user->name }}">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $merchant->user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $merchant->user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $merchant->user->phone_number ?? '-' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($merchant->merchant_status == 'Pending')
                                                    <span class="badge badge-sm bg-gradient-warning">PENDING</span>
                                                @elseif($merchant->merchant_status == 'Approved')
                                                    <span class="badge badge-sm bg-gradient-success">APPROVED</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger">REJECTED</span>
                                                @endif
                                            </td>
                                            <td class="align-middle"
                                                style="display:flex; justify-content: center; align-items:center; height: 100px;">
                                                @if ($merchant->merchant_status == 'Approved')
                                                    <form action="{{ route('merchant.edit', $merchant->user_id) }}"
                                                        method="POST" style="margin-right: 5px;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-xs">
                                                            <i data-feather="edit" style="width: 20px; height: 20px;"
                                                                aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('merchant.destroy', $merchant->user_id) }}"
                                                        method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <a href="{{ route('merchant.destroy', $merchant->user_id) }}"
                                                            class="btn btn-danger btn-xs" data-confirm-delete="true"><i
                                                                data-feather="trash" style="width: 20px; height: 20px;"
                                                                aria-hidden="true"></i></a>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-sm" style="height: 100px;">No data
                                                available..</td>
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

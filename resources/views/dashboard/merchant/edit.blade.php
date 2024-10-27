@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editing: ' . $selected_merchant->name])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Editing: {{ $selected_merchant->name }}</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="px-4 py-2">
                            <form role="form" method="POST"
                                action="{{ route('dashboard_merchants.update', $merchant->id) }}" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Name</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ $selected_merchant->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Email address</label>
                                            <input class="form-control" type="email" name="email"
                                                value="{{ $selected_merchant->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone_number" class="form-control-label">Phone Number</label>
                                            <input class="form-control" type="text" name="phone_number"
                                                value="{{ $selected_merchant->phone_number }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company_description" class="form-control-label">Company
                                                Description</label>
                                            <textarea class="form-control" name="company_description" rows="4">{{ $merchant->company_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

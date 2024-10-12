@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->profile_picture ? asset('/storage/user_profile/' . $user->profile_picture) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTu9zuWJ0xU19Mgk0dNFnl2KIc8E9Ch0zhfCg&s' }}"
                            alt="{{ $user->name }}" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name ?? 'Name should be here..' }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ auth()->user()->role ?? 'Role should be here..' }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="d-flex justify-content-end align-items-center">
                        <form method="POST" action="{{ route('profile.remove_picture', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-secondary">Remove Profile Picture</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div id="alert">
        @include('components.alert')
    </div> --}}
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action="{{ route('profile.update', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{ auth()->user()->id }}" name="id" />
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Change Profile Picture</p>
                            <div class="row pb-3">
                                <div class="form-group">
                                    <label for="profile_picture">Image:</label>
                                    <input class="form-control" type="file" name="profile_picture" id="profile_picture">
                                </div>
                            </div>

                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Name</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name', $user->name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label">Phone Number</label>
                                        <input class="form-control" type="text" name="phone_number"
                                            value="{{ old('phone_number', $user->phone_number) }}">
                                    </div>
                                </div>
                            </div>
                            @can('merchant')
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Company Description</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company-description" class="form-control-label">Company
                                                Description</label>
                                            <textarea class="form-control" name="company_description" rows="4">{{ old('company_description', $user->company_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </form>

                    <form action="{{ route('profile.change_password', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">CHANGE PASSWORD</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Change!</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Current Password</label>
                                        <input class="form-control" type="password" name="current_password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">New Password</label>
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">New Password Confirmation</label>
                                        <input class="form-control" type="password" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

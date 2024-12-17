@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Review Transaction'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body px-0 py-0">
                        <form action="{{ route('dashboard_transactions.review.store', $transaction->id) }}" method="POST">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Review {{ $transaction->product->event_title }}</p>
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                                </div>
                            </div>

                            <div class="card-body">
                                @csrf

                                <div class="row">
                                    <div class="form-group">
                                        <label for="profile_picture">Rating</label>
                                        <select name="rating" id="rating" class="form-control">
                                            <option value="1"
                                                {{ old('rating', $existingReview->rating ?? '') == 1 ? 'selected' : '' }}>1
                                            </option>
                                            <option value="2"
                                                {{ old('rating', $existingReview->rating ?? '') == 2 ? 'selected' : '' }}>2
                                            </option>
                                            <option value="3"
                                                {{ old('rating', $existingReview->rating ?? '') == 3 ? 'selected' : '' }}>3
                                            </option>
                                            <option value="4"
                                                {{ old('rating', $existingReview->rating ?? '') == 4 ? 'selected' : '' }}>4
                                            </option>
                                            <option value="5"
                                                {{ old('rating', $existingReview->rating ?? '') == 5 ? 'selected' : '' }}>5
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="profile_picture">Write your review</label>
                                        <textarea class="form-control" name="comment" id="comment" rows="4" required>{{ old('comment', $existingReview->comment ?? '') }}</textarea>

                                        <div class="form-check form-check-inline mt-3">
                                            <label for="hide_name" class="form-check-label">
                                                <input type="checkbox" id="hide_name" name="hide_name"
                                                    class="form-check-input" value="1"
                                                    {{ old('hide_name', 0) == 1 ? 'checked' : '' }}>
                                                Hide Name in Review
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

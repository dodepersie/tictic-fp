@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Event'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Create Event</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="px-4 py-2">
                            <form role="form" method="POST" action="{{ route('merchant_events.store') }}" class="space-y-6"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_title" class="form-control-label">Event Title</label>
                                            <input class="form-control" type="text" name="event_title" id="event_title"
                                                value="{{ old('event_title') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug" class="form-control-label">Slug</label>
                                            <input class="form-control" type="text" name="slug" id="slug"
                                                value="{{ old('slug') }}" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_start_date" class="form-control-label">Event Start
                                                Date</label>
                                            <input class="form-control" type="date" name="event_start_date"
                                                id="event_start_date" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_price" class="form-control-label">Event Price</label>
                                            Rp <input class="form-control" type="text" name="event_price"
                                                id="event_price" value="{{ old('event_price') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_location" class="form-control-label">Event Location</label>
                                            <input class="form-control" type="text" name="event_location"
                                                id="event_location" value="{{ old('event_location') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_location_longitude" class="form-control-label">Event Location
                                                Longitude</label>
                                            <input class="form-control" type="text" name="event_location_longitude"
                                                id="event_location_longitude" value="{{ old('event_location_longitude') }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_location_latitude" class="form-control-label">Event Location
                                                Latitude</label>
                                            <input class="form-control" type="text" name="event_location_latitude"
                                                id="event_location_latitude" value="{{ old('event_location_latitude') }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_detail" class="form-control-label">Event Detail (soon change
                                                text editor)</label>
                                            <textarea class="form-control" name="event_detail" id="event_detail" rows="4" value="{{ old('event_detail') }}"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <img class="img-preview mb-2" style="display: none; max-width: 100%;" />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_image" class="form-control-label">Event Image</label>
                                            <input class="form-control" type="file" name="event_image" id="event_image"
                                                onChange="previewImage()">
                                            <div class="small font-italic text-muted mt-2">JPG, PNG and WEBP format, size
                                                can't more than 2 MB
                                            </div>
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

@push('script')
    <script>
        const title = document.querySelector('#event_title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        function previewImage() {
            const image = document.querySelector('#event_image');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                imgPreview.style.display = 'block';
                imgPreview.style.height = '10rem';
            }
        }
    </script>
@endpush
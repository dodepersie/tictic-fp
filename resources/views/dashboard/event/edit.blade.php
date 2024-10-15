@extends('layouts.dashboard.main', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Event: ' . $event->event_title])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Event</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="px-4 py-2">
                            <form role="form" method="POST" action="{{ route('merchant_events.update', $event->id) }}"
                                class="space-y-6" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_title" class="form-control-label">Event Title</label>
                                            <input class="form-control" type="text" name="event_title" id="event_title"
                                                value="{{ old('event_title', $event->event_title) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug" class="form-control-label">Slug</label>
                                            <input class="form-control" type="text" name="slug" id="slug"
                                                value="{{ old('slug', $event->slug) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_start_date" class="form-control-label">Event Start
                                                Date</label>
                                            <input class="form-control" type="date" name="event_start_date"
                                                id="event_start_date"
                                                value="{{ old('event_start_date', $event->event_start_date) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_start_time" class="form-control-label">Event Time</label>

                                            <div class="input-group">
                                                <input class="form-control" type="time" name="event_start_time"
                                                    id="event_start_time"
                                                    value="{{ old('event_start_time', $event->event_start_time) }}"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_category" class="form-control-label">Event Category</label>
                                            <select id="event_category" class="form-select w-100" name="category_id"
                                                style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #ccc; background-color: #fff;"
                                                data-placeholder="Select event category..">
                                                <option></option>
                                                @foreach ($categories as $category)
                                                    @if (old('category_id', $event->category->id) == $category->id)
                                                        <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_location" class="form-control-label">Event Location</label>
                                            <input class="form-control" type="text" name="event_location"
                                                id="event_location"
                                                value="{{ old('event_location', $event->event_location) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_location_longitude" class="form-control-label">Event Location
                                                Longitude</label>
                                            <input class="form-control" type="text" name="event_location_longitude"
                                                id="event_location_longitude"
                                                value="{{ old('event_location_longitude', $event->event_location_longitude) }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_location_latitude" class="form-control-label">Event Location
                                                Latitude</label>
                                            <input class="form-control" type="text" name="event_location_latitude"
                                                id="event_location_latitude"
                                                value="{{ old('event_location_latitude', $event->event_location_latitude) }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_detail" class="form-control-label">Event Detail</label>
                                            <textarea class="form-control" name="event_detail" id="event_detail" rows="4">{{ old('event_detail', $event->event_detail) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <img class="img-preview mb-2" style="display: none; max-width: 100%;" />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_image" class="form-control-label">Event Image</label>
                                            <input class="form-control" type="file" name="event_image"
                                                id="event_image" onChange="previewImage()">
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

@push('editor')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('event_start_date').setAttribute('min', formattedDate);
        });
    </script>

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

    <script>
        $(document).ready(function() {
            $('#event_detail').summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['codeview']]
                ]
            });
        });

        $(document).ready(function() {
            $('#event_category').select2({
                placeholder: 'Select event category..',
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: $(this).data('placeholder'),
            });
        });
    </script>
@endpush

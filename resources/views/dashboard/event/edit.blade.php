@php
    $images = explode(',', $event->event_image);
@endphp

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
                                            <label for="event_end_date" class="form-control-label">Event End
                                                Date</label>
                                            <input class="form-control" type="date" name="event_end_date"
                                                id="event_end_date"
                                                value="{{ old('event_end_date', $event->event_end_date) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_start_time" class="form-control-label">Event Time</label>

                                            <div class="input-group">
                                                <input class="form-control" type="time" step="2"
                                                    name="event_start_time" id="event_start_time"
                                                    value="{{ old('event_start_time', $event->event_start_time) }}"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_category" class="form-control-label">Event Category</label>
                                            <select id="event_category" class="form-select" name="category_id"
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
                                        @php
                                            $vvipTicket = $event->ticketTypes->where('type', 'VVIP')->first();
                                            $vipTicket = $event->ticketTypes->where('type', 'VIP')->first();
                                            $regularTicket = $event->ticketTypes->where('type', 'Regular')->first();
                                        @endphp
                                        <div class="ticket-types">
                                            <div class="ticket-type">
                                                <div class="form-group mb-0">
                                                    <!-- Checkbox untuk memilih jenis tiket VVIP -->
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" name="ticket_types[]" value="VVIP"
                                                            class="form-check-input" id="selectVVIP"
                                                            {{ $vvipTicket && $vvipTicket->price && $vvipTicket->quantity ? 'checked' : '' }}>
                                                        <label class="form-check-label font-weight-bold" for="selectVVIP">
                                                            VVIP
                                                        </label>
                                                    </div>

                                                    <!-- Checkbox untuk memilih jenis tiket VIP -->
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" name="ticket_types[]" value="VIP"
                                                            class="form-check-input" id="selectVIP"
                                                            {{ $vipTicket && $vipTicket->price && $vipTicket->quantity ? 'checked' : '' }}>
                                                        <label class="form-check-label font-weight-bold" for="selectVIP">
                                                            VIP
                                                        </label>
                                                    </div>

                                                    <!-- Checkbox untuk memilih jenis tiket Regular -->
                                                    <div class="form-check form-check-inline">
                                                        <input type="checkbox" name="ticket_types[]" value="Regular"
                                                            class="form-check-input" id="selectRegular"
                                                            {{ $regularTicket && $regularTicket->price && $regularTicket->quantity ? 'checked' : '' }}>
                                                        <label class="form-check-label font-weight-bold"
                                                            for="selectRegular">
                                                            Regular
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- Area input form dinamis -->
                                                <div class="col-md-12">
                                                    <!-- Form untuk VVIP -->
                                                    <div class="form-group mt-2" id="VVIP-form" style="display:none;">
                                                        <h4>VVIP Ticket Settings</h4>

                                                        <!-- Input untuk harga VVIP -->
                                                        <label for="vvip_price" class="form-control-label">Price:</label>
                                                        <input class="form-control mb-2" type="text" name="vvip_price"
                                                            id="vvip_price" placeholder="Enter VVIP Price"
                                                            value="{{ old('vvip_price', $vvipTicket->price ?? '') }}">

                                                        <!-- Input untuk kuantitas VVIP -->
                                                        <label for="vvip_quantity"
                                                            class="form-control-label">Quantity:</label>
                                                        <input class="form-control mb-2" type="number"
                                                            name="vvip_quantity" id="vvip_quantity"
                                                            placeholder="Enter VVIP Quantity"
                                                            value="{{ old('vvip_quantity', $vvipTicket->quantity ?? '') }}">
                                                    </div>

                                                    <!-- Form untuk VIP -->
                                                    <div class="form-group mt-2" id="VIP-form" style="display:none;">
                                                        <h4>VIP Ticket Settings</h4>
                                                        <label for="vip_price" class="form-control-label">Price:</label>
                                                        <input class="form-control mb-2" type="text" name="vip_price"
                                                            id="vip_price" placeholder="Enter VIP Price"
                                                            value="{{ old('vip_price', $vipTicket->price ?? '') }}">
                                                        <label for="vip_quantity"
                                                            class="form-control-label">Quantity:</label>
                                                        <input class="form-control mb-2" type="number"
                                                            name="vip_quantity" id="vip_quantity"
                                                            placeholder="Enter VIP Quantity"
                                                            value="{{ old('vip_quantity', $vipTicket->quantity ?? '') }}">
                                                    </div>

                                                    <!-- Form untuk Regular -->
                                                    <div class="form-group mt-2" id="Regular-form" style="display:none;">
                                                        <h4>Regular Ticket Settings</h4>
                                                        <label for="regular_price"
                                                            class="form-control-label">Price:</label>
                                                        <input class="form-control mb-2" type="text"
                                                            name="regular_price" id="regular_price"
                                                            placeholder="Enter Regular Price"
                                                            value="{{ old('regular_price', $regularTicket->price ?? '') }}">
                                                        <label for="regular_quantity"
                                                            class="form-control-label">Quantity:</label>
                                                        <input class="form-control mb-2" type="number"
                                                            name="regular_quantity" id="regular_quantity"
                                                            placeholder="Enter Regular Quantity"
                                                            value="{{ old('regular_price', $regularTicket->quantity ?? '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Event Location</label>
                                            <div id="map"></div>
                                            <input type="hidden" name="event_address" id="event_address"
                                                value="{{ $event->event_address }}">
                                            <input type="hidden" name="event_location" id="event_location"
                                                value="{{ $event->event_location }}">
                                            <input type="hidden" name="event_location_latitude"
                                                id="event_location_latitude"
                                                value="{{ $event->event_location_latitude }}">
                                            <input type="hidden" name="event_location_longitude"
                                                id="event_location_longitude"
                                                value="{{ $event->event_location_longitude }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_detail" class="form-control-label">Event Detail</label>
                                            <textarea class="form-control" name="event_detail" id="event_detail" rows="4">{{ old('event_detail', $event->event_detail) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="img-preview-container col-auto d-flex gap-3 mb-2">
                                        @foreach ($images as $image)
                                            <div class="d-flex">
                                                <img src="{{ asset('storage/event_images/' . $image) }}"
                                                    alt={{ $event->event_title }}"
                                                    style="max-width: 100%; height: 10rem; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="event_images" class="form-control-label">Event Images</label>
                                            <input class="form-control" type="file" name="event_images[]"
                                                id="event_images" onChange="previewImage()" multiple
                                                accept=".jpg,.jpeg,.png,.webp">
                                            <div class="small font-italic text-muted mt-2">
                                                JPG, PNG, and WEBP formats are allowed. Maximum size: 2 MB per image.
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
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
@endpush

@push('map')
    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            const forms = {
                VVIP: document.getElementById('VVIP-form'),
                VIP: document.getElementById('VIP-form'),
                Regular: document.getElementById('Regular-form')
            };

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        forms[this.value].style.display =
                            'block';
                    } else {
                        forms[this.value].style.display =
                            'none';
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var lat = parseFloat('{{ old('event_location_latitude', $event->event_location_latitude ?? 0) }}');
            var lng = parseFloat('{{ old('event_location_longitude', $event->event_location_longitude ?? 0) }}');

            var map = L.map('map').setView([lat, lng], 18);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            var marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function(e) {
                var latlng = marker.getLatLng();
                var lat = latlng.lat;
                var lng = latlng.lng;

                document.getElementById('event_location_latitude').value = lat;
                document.getElementById('event_location_longitude').value = lng;

                var apiUrl =
                    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.address) {
                            var address = data.display_name;
                            var county = data.address.municipality || data.address.county || data
                                .address.city || data.address.suburb || data.address.district || '';
                            var state = data.address.state || data.address.territory || data
                                .address.city || '';

                            var locationString = county && state ? county + ', ' + state : county ||
                                state;

                            document.getElementById('event_address').value = address;
                            document.getElementById('event_location').value = locationString;
                        } else {
                            console.error('Address data not found');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching location data:', error);
                    });
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                document.getElementById('event_location_latitude').value = lat;
                document.getElementById('event_location_longitude').value = lng;

                var apiUrl =
                    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.address) {
                            var address = data.display_name;
                            var county = data.address.municipality || data.address.county || data
                                .address.city || data.address.suburb || data.address.district || '';
                            var state = data.address.state || data.address.territory || data
                                .address.city || '';

                            var locationString = county && state ? county + ', ' + state : county ||
                                state;

                            document.getElementById('event_address').value = address;
                            document.getElementById('event_location').value = locationString;
                        } else {
                            console.error('Address data not found');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching location data:', error);
                    });
            });
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
    </script>

    <script>
        function previewImage() {
            const imageInput = document.querySelector('#event_images');
            const previewContainer = document.querySelector('.img-preview-container');

            previewContainer.innerHTML = '';

            if (imageInput.files && imageInput.files.length > 0) {
                Array.from(imageInput.files).forEach(file => {
                    const oFReader = new FileReader();
                    const imgElement = document.createElement('img');

                    imgElement.style.display = 'block';
                    imgElement.style.height = '10rem';
                    imgElement.style.objectFit = 'cover';

                    oFReader.onload = function(oFREvent) {
                        imgElement.src = oFREvent.target.result;
                    };

                    oFReader.readAsDataURL(file);
                    previewContainer.appendChild(imgElement);
                });
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#event_detail').summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
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
                width: '100%',
                placeholder: $(this).data('placeholder'),
            });
        });
    </script>
@endpush

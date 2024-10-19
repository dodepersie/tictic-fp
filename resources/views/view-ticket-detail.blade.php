@extends('layouts.main')

@section('container')
    <section>
        <div class="flex flex-col justify-center items-center">
            <div class="container mx-auto max-w-2xl space-y-5 py-10 lg:pt-20">
                <header>
                    <h2 class="text-center text-2xl font-bold text-gray-900 sm:text-3xl">View Ticket Details</h2>
                </header>

                <form action="{{ route('view-ticket-detail') }}" method="POST" class="w-full">
                    @csrf
                    <div class="lg:flex justify-center items-center gap-4 space-y-4 lg:space-y-0">
                        <div class="lg:w-1/2">
                            <div class="relative">
                                <input type="text" name="unique_id"
                                    class="w-full h-10 rounded-lg border-gray-200 px-4 pr-12 text-sm"
                                    placeholder="Enter your Unique Transaction ID.." value="{{ old('unique_id') }}"
                                    autocomplete="off" />
                                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                                    <svg class="size-4 text-gray-400" fill="none" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                class="group relative block text-md font-bold text-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900 text-center">
                                <div
                                    class="h-full rounded-md border-2 border-slate-900 bg-slate-900 transition group-hover:-translate-y-2 group-hover:-translate-x-2">

                                    <span class="relative block px-4 py-1"> View Ticket! </span>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>

                @if (session('transaction'))
                    <div class="mt-5 p-4 border border-gray-200 rounded-lg">
                        <div class="leading-loose">
                            <h3 class="text-lg font-semibold border-b border-gray-200 pb-3 mb-3">Ticket Details</h3>
                            <div><strong>Payment Status:</strong>
                                @if (session('transaction')->status == 'Success')
                                    <span
                                        class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="-ms-1 me-1.5 size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>

                                        <p class="whitespace-nowrap text-sm">Paid</p>
                                    </span>
                                @elseif(session('transaction')->status == 'Pending')
                                    <span
                                        class="inline-flex items-center justify-center rounded-full bg-red-100 px-2.5 py-0.5 text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="-ms-1 me-1.5 size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>

                                        <p class="whitespace-nowrap text-sm">{{ session('transaction')->status }}</p>
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center justify-center rounded-full bg-amber-100 px-2.5 py-0.5 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="-ms-1 me-1.5 size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9.75h4.875a2.625 2.625 0 010 5.25H12M8.25 9.75L10.5 7.5M8.25 9.75L10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                                        </svg>

                                        <p class="whitespace-nowrap text-sm">{{ session('transaction')->status }}</p>
                                    </span>
                                @endif
                            </div>
                            <div><strong>Unique ID:</strong> #{{ session('transaction')->unique_id }}</div>
                            <!-- masih perlu ditambahkan agar bisa melihat ticket type -->
                            <div><strong>Ticket Type:</strong> {{ session('transaction')->ticketType->type }}</div>
                            <div><strong>Quantity:</strong> {{ session('transaction')->quantity }}</div>
                        </div>

                        <div class="leading-loose">
                            <h3 class="text-lg font-semibold border-b border-gray-200 py-3 mb-3">Event Details</h3>
                            <div><strong>Event Title:</strong> {{ ucfirst(session('transaction')->product->event_title) }}
                            </div>
                            <div><strong>Ticket Price:</strong> IDR
                                {{ number_format(session('transaction')->price, 0, ',', '.') }}
                            </div>
                            <div><strong>Event Start Date:</strong>
                                {{ \Carbon\Carbon::parse(session('transaction')->product->event_start_date)->format('d F Y') }}
                            </div>
                            <div><strong>Event Start Time:</strong>
                                {{ \Carbon\Carbon::parse(session('transaction')->product->event_start_time)->format('H:i') }}
                            </div>
                            <div><strong>Event Address:</strong> {{ session('transaction')->product->event_address }}
                            </div>
                            <div><strong>Event Location:</strong> {{ session('transaction')->product->event_location }}
                            </div>
                            <div><strong>Purchased By:</strong> {{ session('transaction')->user->name }}</div>
                            <div><strong>Order Date:</strong>
                                {{ session('transaction')->created_at->format('d F Y - H:i:s') }}</div>
                        </div>
                    </div>

                    @if (session('transaction')->status === 'Pending')
                        <a class="mt-3 group relative block text-md font-bold text-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900 text-center"
                            href="{{ route('checkout', session('transaction')->id) }}">
                            <div
                                class="h-full rounded-md border-2 border-slate-900 bg-slate-900 transition group-hover:-translate-y-2 group-hover:-translate-x-2">

                                <span class="relative block py-2"> Pay now </span>
                            </div>
                        </a>
                    @endif
            </div>
        @elseif ($errors->any())
            <div class="mt-5 p-4 border border-red-200 bg-red-50 text-red-800 rounded-lg">
                <h3 class="text-lg font-semibold">Error</h3>
                <p>{{ $errors->first() }}</p>
            </div>
            @endif
        </div>
        </div>
    </section>
@endsection

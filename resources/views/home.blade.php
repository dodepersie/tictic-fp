@extends('layouts.main')

@section('container')
    <!-- Call To Action -->
    <section class="bg-gray-50">
        <div class="p-8 pt-28 md:p-12 lg:px-16 lg:pb-24 lg:pt-32">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-2xl text-gray-900 md:text-3xl leading-loose">
                    Hey you, <span class="font-bold">Which concert you want to see?</span>
                </h2>
            </div>

            <div class="mx-auto mt-8 max-w-xl">
                <form action="#" class="sm:flex sm:gap-4">
                    <div class="sm:flex-1">
                        <label for="search" class="sr-only">Event Name</label>

                        <input id="search" type="text" placeholder="BLACKPINK World Tour 2024 Concert" name="search"
                            class="border w-full rounded-md border-gray-200 bg-white p-3 text-gray-700 shadow-sm transition focus:border-white focus:outline-none focus:ring focus:ring-blue-400"
                            autocomplete="off" />
                    </div>

                    <button
                        class="mt-4 group relative w-full inline-flex justify-center items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto sm:mt-0">
                        <span class="absolute -end-full transition-all group-hover:end-4">
                            <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>

                        <span class="text-sm font-medium transition-all group-hover:me-4"> Search </span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Product List -->
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <header>
                <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">Special Concert Ticket Price! 😍</h2>

                <p class="mt-4 max-w-md text-gray-500">
                    Enjoy good concert with special price only on TicTic!
                </p>
            </header>

            <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                    <x-home-ticket href="/event/{{ $product->slug }}">
                        <img alt="Event thumbnail"
                            src="https://images.unsplash.com/photo-1613545325278-f24b0cae1224?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                            class="h-56 w-full rounded-md object-cover" />

                        @slot('product', $product)
                    </x-home-ticket>
                @endforeach
            </ul>

            <div class="flex justify-center items-center mt-10">
                <a class="group relative inline-block text-sm font-medium text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                    href="/event">
                    <span
                        class="absolute inset-0 translate-x-0 translate-y-0 bg-indigo-600 transition-transform group-hover:translate-x-0.5 group-hover:translate-y-0.5"></span>

                    <span class="relative block border border-current bg-white px-8 py-3"> Check Another Ticket
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Profit -->
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
                <div class="relative h-64 overflow-hidden rounded-lg sm:h-80 lg:order-last lg:h-full">
                    <img alt="Illustration"
                        src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="absolute inset-0 h-full w-full object-cover" />
                </div>

                <div class="lg:py-24">
                    <h2 class="text-3xl font-bold sm:text-4xl">Order Concert Ticket Easily!</h2>

                    <p class="mt-4 text-gray-600">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut qui hic atque tenetur quis
                        eius quos ea neque sunt, accusantium soluta minus veniam tempora deserunt? Molestiae eius
                        quidem quam repellat.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

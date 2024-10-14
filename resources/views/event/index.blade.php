@extends('layouts.main')

@section('container')
    <section>
        <header>
            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl"> {{ $title }} 😍🎉</h2>
        </header>

        <div class="mt-4 gap-4">
            {{-- <div class="col-span-1 mt-4">
                <div class="space-y-2">
                    <div x-data="{ isOpen: false }" class="overflow-hidden rounded border border-gray-300">
                        <button x-on:click="isOpen = !isOpen" type="button"
                            class="flex w-full cursor-pointer items-center justify-between gap-2 bg-white p-4 text-gray-900 transition">
                            <span class="text-sm font-medium"> Availability </span>

                            <span class="transition" :class="{ '-rotate-180': isOpen }">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>

                        <div x-cloak x-show="isOpen" x-on:keydown.escape.window="isOpen = false"
                            class="border-t border-gray-200 bg-white">
                            <header class="flex items-center justify-between p-4">
                                <span class="text-sm text-gray-700"> 0 Selected </span>

                                <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                                    Reset
                                </button>
                            </header>

                            <ul class="space-y-1 border-t border-gray-200 p-4">
                                <li>
                                    <label for="FilterInStock" class="inline-flex items-center gap-2">
                                        <input type="checkbox" id="FilterInStock" class="size-5 rounded border-gray-300" />

                                        <span class="text-sm font-medium text-gray-700"> In Stock (5+) </span>
                                    </label>
                                </li>

                                <li>
                                    <label for="FilterPreOrder" class="inline-flex items-center gap-2">
                                        <input type="checkbox" id="FilterPreOrder" class="size-5 rounded border-gray-300" />

                                        <span class="text-sm font-medium text-gray-700"> Pre Order (3+) </span>
                                    </label>
                                </li>

                                <li>
                                    <label for="FilterOutOfStock" class="inline-flex items-center gap-2">
                                        <input type="checkbox" id="FilterOutOfStock"
                                            class="size-5 rounded border-gray-300" />

                                        <span class="text-sm font-medium text-gray-700"> Out of Stock (10+) </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div x-data="{ isOpen: false }" class="overflow-hidden rounded border border-gray-300">
                        <button x-on:click="isOpen = !isOpen" type="button"
                            class="flex w-full cursor-pointer items-center justify-between gap-2 bg-white p-4 text-gray-900 transition">
                            <span class="text-sm font-medium"> Price </span>

                            <span class="transition" :class="{ '-rotate-180': isOpen }">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>

                        <div x-cloak x-show="isOpen" x-on:keydown.escape.window="isOpen = false"
                            class="border-t border-gray-200 bg-white">
                            <header class="flex items-center justify-between p-4">
                                <span class="text-sm text-gray-700"> The highest price is $600 </span>

                                <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                                    Reset
                                </button>
                            </header>

                            <div class="border-t border-gray-200 p-4">
                                <div class="flex justify-between gap-4">
                                    <label for="FilterPriceFrom" class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Rp</span>

                                        <input type="number" id="FilterPriceFrom" placeholder="0"
                                            class="w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                                    </label>

                                    <label for="FilterPriceTo" class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Rp</span>

                                        <input type="number" id="FilterPriceTo" placeholder="0"
                                            class="w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div>
                @if ($products->count())
                    <ul class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4 my-4">
                        @foreach ($products as $product)
                            <x-home-ticket href="{{ route('event.show', $product->slug) }}">
                                @slot('product', $product)
                            </x-home-ticket>
                        @endforeach
                    </ul>
                @else
                    <div class="text-md">
                        No events available..
                    </div>
                @endif
            </div>
        </div>

        {{ $products->links() }}
    </section>
@endsection

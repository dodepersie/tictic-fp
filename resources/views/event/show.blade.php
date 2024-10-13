@extends('layouts.main')

@section('container')
    <section>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Content -->
            <div class="space-y-4 lg:col-span-2">
                <!-- Header -->
                <div class="space-y-2">
                    <h2 class="font-afacadflux text-3xl sm:text-4xl text-gray-900 font-bold leading-relaxed tracking-tight">
                        {{ ucfirst($product->event_title) }}</span>
                    </h2>

                    <div class="text-md leading-loose">
                        <!-- Event Date and Location -->
                        <div>
                            Event Date: <span
                                class="font-bold">{{ date('d F Y', strtotime($product->event_start_date)) }}</span> —
                            Event Location: <a href="/events?location={{ $product->event_location }}" class="underline"
                                title="More event at {{ $product->event_location }}"><span
                                    class="font-bold">{{ $product->event_location }}</span></a>
                        </div>
                    </div>
                    <!-- Star -->
                    <div class="lg:flex justify-start items-center gap-1.5">
                        <div class="flex lg:justify-center gap-0.5 text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <!-- Reviews Count -->
                        <div>99999 Reviews</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <img src="{{ $product->event_image ? '/storage/event_images/' . $product->event_image : 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop ?>' }}"
                        alt="{{ ucfirst($product->event_title) }}" class="h-auto object-contain rounded-xl shadow" />
                </div>

                <div class="space-y-2">
                    <span class="text-xl font-semibold">Event Description</span>
                    <p class="text-justify leading-loose">
                        {!! $product->event_detail !!}
                    </p>
                </div>

                <div class="space-y-2">
                    <span class="text-xl font-semibold">Reviews</span>

                    <div>
                        Kotak review
                    </div>
                </div>
            </div>

            <!-- Aside -->
            <aside class="sticky top-16">
                <div class="space-y-4">
                    <!-- About Merchant -->
                    <div class="space-y-3">
                        <h2 class="font-bold text-xl">About {{ $product->merchant->user->name }}</h2>

                        <div class="flex items-center gap-4">
                            <img src="{{ $product->merchant->user->profile_picture ? asset('/storage/user_profile/' . $product->merchant->user->profile_picture) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTu9zuWJ0xU19Mgk0dNFnl2KIc8E9Ch0zhfCg&s' }}"
                                alt="{{ $product->merchant->user->name }}" class="size-20 rounded-lg object-cover" />

                            <div>
                                <p class="mt-0.5 text-gray-700">
                                    {{ $product->merchant->user->company_description ? $product->merchant->user->company_description : 'This merchant not set company description.. 😅' }}
                                </p>
                            </div>
                        </div>

                        <a class="group flex items-center justify-between gap-4 rounded-lg border border-indigo-600 bg-indigo-600 px-3 py-2 transition-colors hover:bg-transparent focus:outline-none focus:ring"
                            href="/events?merchant={{ $product->merchant->id }}">
                            <span
                                class="font-medium text-white transition-colors group-hover:text-indigo-600 group-active:text-indigo-500">
                                Look more from {{ $product->merchant->user->name }}
                            </span>

                            <span
                                class="shrink-0 rounded-full border border-current bg-white p-2 text-indigo-600 group-active:text-indigo-500">
                                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Order information -->
                    <div>
                        <h2 class="font-bold text-xl">Order Information</h2>
                        <div class="space-y-4">
                            <!-- Ticket Type -->
                            <fieldset class="space-y-4">
                                <legend class="sr-only">Ticket Type</legend>

                                <div>
                                    <label for="TicketVVIP"
                                        class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 bg-white p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                        <p class="text-gray-700">VVIP</p>

                                        <p class="text-gray-900">Rp xxxx</p>

                                        <input type="radio" name="TicketOption" value="TicketVVIP" id="TicketVVIP"
                                            class="sr-only" checked />
                                    </label>
                                </div>

                                <div>
                                    <label for="TicketVIP"
                                        class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 bg-white p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                        <p class="text-gray-700">VIP</p>

                                        <p class="text-gray-900">Rp xxx</p>

                                        <input type="radio" name="TicketOption" value="TicketVIP" id="TicketVIP"
                                            class="sr-only" />
                                    </label>
                                </div>
                            </fieldset>

                            <!-- Quantity -->
                            <div x-data="{ productQuantity: 1, productPrice: {{ $product->event_price }} }">
                                <div class="flex justify-between items-center">
                                    <!-- This price will change based on "PRICE x QUANTITY" -->
                                    <h2 class="text-2xl">
                                        Rp <span x-text="(productPrice * productQuantity).toLocaleString('id-ID')"></span>
                                    </h2>

                                    <label for="Quantity" class="sr-only">Quantity</label>
                                    <div class="flex items-center rounded border border-gray-200">
                                        <button type="button" x-on:click="productQuantity--"
                                            :disabled="productQuantity === 1"
                                            class="size-10 leading-10 text-gray-600 transition hover:opacity-75">
                                            &minus;
                                        </button>

                                        <input type="number" id="Quantity" x-model="productQuantity" min="1"
                                            class="h-10 w-16 border-transparent text-center sm:text-sm" />

                                        <button type="button" x-on:click="productQuantity++"
                                            class="size-10 leading-10 text-gray-600 transition hover:opacity-75">
                                            &plus;
                                        </button>
                                    </div>
                                </div>

                                <div class="flex justify-end items-center pt-3 mt-3 border-t border-gray-200">
                                    <form action="{{ route('checkout-proccess') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="price" value="{{ $product->event_price }}">
                                        <button
                                            class="group relative inline-block text-sm font-medium bg-white focus:outline-none focus:ring active:text-blue-500">
                                            <span class="absolute inset-0 border border-current"></span>
                                            <span
                                                class="text-white block border border-current bg-blue-600 px-4 py-2 sm:py-2.5 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                                                Pay with Midtrans
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

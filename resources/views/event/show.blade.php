@extends('layouts.main')

@section('container')
    <section>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Content -->
            <div class="space-y-4 lg:col-span-2">
                <h2 class="font-afacadflux text-3xl sm:text-4xl text-gray-900 font-bold leading-relaxed tracking-tight">
                    {{ ucfirst($product->event_title) }}</span>
                </h2>

                <div class="text-md leading-loose">
                    <div class="lg:flex justify-start items-center gap-1.5">
                        <!-- Star -->
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
                        <!-- Event Date -->
                        <div>Event Date: {{ date('d F Y', strtotime($product->event_start_date)) }}</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="{{ ucfirst($product->event_title) }}" class="h-auto object-contain rounded-xl shadow" />
                </div>

                <div class="space-y-2">
                    <span class="flex items-center">
                        <span class="pr-3 text-xl font-semibold">Event Description</span>
                        <span class="h-px flex-1 bg-black"></span>
                    </span>
                    <p class="text-justify leading-loose">
                        {{ $product->event_detail }}
                    </p>
                </div>

                <div class="space-y-2">
                    <span class="flex items-center">
                        <span class="h-px flex-1 bg-black"></span>
                        <span class="pl-3 text-xl font-semibold">Reviews</span>
                    </span>

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
                        <h2 class="font-bold text-xl">About NAMA MERCHANT</h2>

                        <div class="flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2680&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Merchant Name" class="size-20 rounded-lg object-cover" />

                            <div>
                                <h3 class="text-lg/tight font-medium text-gray-900">Title goes here</h3>

                                <p class="mt-0.5 text-gray-700">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates voluptas
                                    distinctio
                                    nesciunt quas non animi.
                                </p>
                            </div>
                        </div>
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
                                    <button
                                        class="group relative inline-block text-sm font-medium bg-white focus:outline-none focus:ring active:text-blue-500">
                                        <span class="absolute inset-0 border border-current"></span>
                                        <span
                                            class="text-white block border border-current bg-blue-600 px-4 py-2 sm:py-2.5 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                                            Pay with Midtrans
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

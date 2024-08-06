@extends('layouts.main')

@section('container')
    <section class="container mx-auto p-8 pt-24 md:p-12 lg:px-8 lg:pb-24 lg:pt-24 space-y-3">
        <div class="lg:grid grid-cols-3 gap-10 space-y-10 lg:space-y-0">
            <div class="col-span-2 space-y-4">
                <h2 class="font-quicksand text-4xl text-gray-900 md:text-3xl leading-relaxed tracking-tight">
                    {{ ucfirst($product->event_title) }}</span>
                </h2>

                <div class="text-sm leading-loose">
                    <div class="flex items-center gap-1">
                        <i data-feather="star" class="size-4 text-yellow-400"></i>
                        <span>5.0 | 99999999999 reviews | Event Date:
                            {{ date('d F Y', strtotime($product->event_start_date)) }}</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <h2 class="text-lg font-semibold">Description</h2>
                    <p class="leading-loose tracking-wide">
                        {{ $product->event_detail }}
                    </p>
                </div>

                <div class="space-y-3">
                    <h2 class="text-lg font-semibold">About (nama merchant)</h2>

                    <article class="rounded-xl bg-white p-4 ring ring-indigo-50 sm:p-6 lg:p-8">
                        <div class="flex items-start sm:gap-8">
                            <div class="hidden sm:grid sm:size-20 sm:shrink-0 sm:place-content-center sm:rounded-full sm:border-2 sm:border-indigo-500"
                                aria-hidden="true">
                                <div class="flex items-center gap-1">
                                    <span class="h-8 w-0.5 rounded-full bg-indigo-500"></span>
                                    <span class="h-6 w-0.5 rounded-full bg-indigo-500"></span>
                                    <span class="h-4 w-0.5 rounded-full bg-indigo-500"></span>
                                    <span class="h-6 w-0.5 rounded-full bg-indigo-500"></span>
                                    <span class="h-8 w-0.5 rounded-full bg-indigo-500"></span>
                                </div>
                            </div>

                            <div>
                                <strong
                                    class="rounded border border-indigo-500 bg-indigo-500 px-3 py-1.5 text-[10px] font-medium text-white">
                                    Episode #101
                                </strong>

                                <h3 class="mt-4 text-lg font-medium sm:text-xl">
                                    <a href="#" class="hover:underline"> Some Interesting Podcast Title </a>
                                </h3>

                                <p class="mt-1 text-sm text-gray-700">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsam nulla amet
                                    voluptatum sit
                                    rerum, atque, quo culpa ut necessitatibus eius suscipit eum accusamus, aperiam
                                    voluptas
                                    exercitationem facere aliquid fuga. Sint.
                                </p>

                                <div class="mt-4 sm:flex sm:items-center sm:gap-2">
                                    <div class="flex items-center gap-1 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>

                                        <p class="text-xs font-medium">48:32 minutes</p>
                                    </div>

                                    <span class="hidden sm:block" aria-hidden="true">&middot;</span>

                                    <p class="mt-2 text-xs font-medium text-gray-500 sm:mt-0">
                                        Featuring <a href="#" class="underline hover:text-gray-700">Barry</a>,
                                        <a href="#" class="underline hover:text-gray-700">Sandra</a> and
                                        <a href="#" class="underline hover:text-gray-700">August</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <aside class="sticky top-[75px] col-span-1">
                <div class="space-y-2 mb-2 mt-6 border-b border-gray-200 pb-5">
                    <h2 class="font-bold">Order Information</h2>
                    <!-- Ticket Type -->
                    <fieldset class="space-y-4">
                        <legend class="sr-only">Delivery</legend>

                        <div>
                            <label for="DeliveryStandard"
                                class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 bg-white p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                <p class="text-gray-700">VVIP</p>

                                <p class="text-gray-900">Rp xxxx</p>

                                <input type="radio" name="DeliveryOption" value="DeliveryStandard" id="DeliveryStandard"
                                    class="sr-only" checked />
                            </label>
                        </div>

                        <div>
                            <label for="DeliveryPriority"
                                class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 bg-white p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                <p class="text-gray-700">VIP</p>

                                <p class="text-gray-900">Rp xxx</p>

                                <input type="radio" name="DeliveryOption" value="DeliveryPriority" id="DeliveryPriority"
                                    class="sr-only" />
                            </label>
                        </div>
                    </fieldset>

                    <!-- Quantity -->
                    <div x-data="{ productQuantity: 1 }">
                        <label for="Quantity" class="sr-only"> Quantity </label>

                        <div class="max-w-xl mt-5">
                            <div class="flex justify-end">
                                <button
                                    class="group relative inline-block text-sm font-medium bg-white focus:outline-none focus:ring active:text-red-500"
                                    type="button" x-on:click="productQuantity--" :disabled="productQuantity === 0">
                                    <span class="absolute inset-0 border border-current"></span>
                                    <span
                                        class="text-white block border border-current bg-red-600 disabled:bg-red-600/50 px-4 py-2.5 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                                        &minus;
                                    </span></button>

                                <input type="number" id="Quantity" x-model="productQuantity"
                                    class="border-transparent h-10 w-16 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none" />

                                <button
                                    class="group relative inline-block text-sm font-medium bg-white focus:outline-none focus:ring active:text-blue-500"
                                    type="button" x-on:click="productQuantity++">
                                    <span class="absolute inset-0 border border-current"></span>
                                    <span
                                        class="text-white block border border-current bg-blue-600 px-4 py-2 sm:py-2.5 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                                        &plus;
                                    </span></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-3">
                    <h2 class="text-2xl">Rp {{ number_format($product->event_price) }}</h2>
                    <button
                        class="group relative inline-block text-sm font-medium bg-white focus:outline-none focus:ring active:text-blue-500">
                        <span class="absolute inset-0 border border-current"></span>
                        <span
                            class="text-white block border border-current bg-blue-600 px-4 py-2 sm:py-2.5 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                            Pay with Midtrans
                        </span></button>
                </div>
            </aside>
        </div>
    </section>
@endsection

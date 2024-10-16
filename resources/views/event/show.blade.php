@extends('layouts.main')

@section('container')
    <section>
        <div class="relative max-w-[74.5rem] mx-auto px-2 lg:px-0 pb-10">
            <div class="lg:grid grid-cols-12 justify-start items-start space-y-4 lg:gap-8 w-full mx-auto sm:px-6 lg:px-8">
                <!-- Content -->
                <div class="space-y-4 lg:col-span-8">
                    <!-- Header -->
                    <div class="space-y-4">
                        <h2
                            class="font-afacadflux text-3xl sm:text-4xl text-gray-900 font-bold leading-relaxed tracking-tight">
                            {{ ucfirst($product->event_title) }}</span>
                        </h2>

                        <div class="text-sm leading-loose">
                            <!-- Event Date Time and Location -->
                            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-2">
                                <div class="flex items-center gap-2">
                                    <i data-feather="calendar"></i> <span class="font-semibold">
                                        @if ($product->event_start_date == $product->event_end_date)
                                            {{ date('d F Y', strtotime($product->event_start_date)) }}
                                        @else
                                            {{ date('d F Y', strtotime($product->event_start_date)) }} -
                                            {{ date('d F Y', strtotime($product->event_end_date)) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-feather="clock"></i> <span
                                        class="font-semibold">{{ date('H:i', strtotime($product->event_start_time)) }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-feather="map-pin"></i> <a href="/events?location={{ $product->event_location }}"
                                        class="underline" title="More event at {{ $product->event_location }}"><span
                                            class="font-semibold">{{ $product->event_location }}</span></a>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-feather="tag"></i><span class="font-semibold "><a
                                            href="/events?category={{ $product->category->name }}" class="underline"><span
                                                class="font-semibold">{{ $product->category->name }}</span></a></span>
                                </div>
                                <!-- Star Rating Display -->
                                <div class="flex items-center gap-0.5">
                                    <div class="flex text-green-500">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $averageRating)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20"
                                                    fill="currentColor" opacity="0.3">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <!-- Display Reviews Count -->
                                    <div>{{ $reviewsCount }} {{ Str::plural('Review', $reviewsCount) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <img src="{{ $product->event_image ? '/storage/event_images/' . $product->event_image : 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop' }}"
                            alt="{{ ucfirst($product->event_title) }}" class="h-auto object-contain rounded-xl shadow"
                            id="event_image" />
                    </div>

                    <!-- Another Tab Try -->
                    <div x-data="{ openTab: 1 }">
                        <!-- Tabs Navigation -->
                        <div id="Tab"
                            class="flex flex-col md:flex-row md:items-center md:gap-4 border-b lg:border-gray-200 font-medium">
                            <!-- Event Description -->
                            <button @click="openTab = 1"
                                :class="{
                                    'text-sky-600 md:border-b lg:border-sky-500 px-1 pb-4 hover:text-gray-500 hover:border-gray-500': openTab ===
                                        1,
                                    'text-gray-500 border-b border-transparent md:hover:border-gray-500 px-1 pb-4': openTab !==
                                        1
                                }"
                                class="flex items-center gap-2"><svg class="w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                                        clip-rule="evenodd" />
                                </svg>Event
                                Description</button>
                            <!-- Event Map -->
                            <button @click="openTab = 2"
                                :class="{
                                    'text-sky-600 md:border-b border-sky-500 px-1 pb-4 hover:text-gray-500 md:hover:border-gray-500': openTab ===
                                        2,
                                    'text-gray-500 border-b border-transparent md:hover:border-gray-500 px-1 pb-4': openTab !==
                                        2
                                }"
                                class="flex items-center gap-2"><svg class="w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                        clip-rule="evenodd" />
                                </svg>Event
                                Map</button>
                            <!-- Reviews -->
                            <button @click="openTab = 3"
                                :class="{
                                    'text-sky-600 md:border-b border-sky-500 px-1 pb-4 hover:text-gray-500 md:hover:border-gray-500': openTab ===
                                        3,
                                    'text-gray-500 border-b border-transparent md:hover:border-gray-500 px-1 pb-4': openTab !==
                                        3
                                }"
                                class="flex items-center gap-2">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                                        clip-rule="evenodd" />
                                </svg>{{ $reviewsCount }} {{ Str::plural('Review', $reviewsCount) }}</button>
                            <!-- Related Events -->
                            <button @click="openTab = 4"
                                :class="{
                                    'text-sky-600 md:border-b border-sky-500 px-1 pb-4 hover:text-gray-500 md:hover:border-gray-500': openTab ===
                                        4,
                                    'text-gray-500 border-b border-transparent md:hover:border-gray-500 px-1 pb-4': openTab !==
                                        4
                                }"
                                class="flex items-center gap-2"><svg class="w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                                </svg>Related
                                Events</button>
                        </div>

                        <!-- Tab Content -->
                        <div class="mt-4">
                            <div x-show="openTab === 1">
                                <h2 class="text-xl font-semibold">Event Description</h2>
                                <div class="mt-2 text-justify leading-loose">{!! $product->event_detail !!}</div>
                            </div>
                            <div x-show="openTab === 2">
                                <div>Google Maps apakah bisa?</div>
                            </div>
                            <div x-show="openTab === 3">
                                <div class="space-y-2">
                                    @forelse($reviews as $review)
                                        <div class="space-y-3">
                                            <div class="p-4 rounded-lg border-2 border-dashed border-slate-900 mb-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <div>
                                                        <strong class="text-lg">{{ $review->user->name }}</strong>
                                                        <span class="text-gray-500 text-sm">on
                                                            {{ $review->created_at->format('d F Y - H:i:s') }}</span>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="text-yellow-500">{{ str_repeat('★', $review->rating) }}</span><span
                                                            class="text-gray-500">{{ str_repeat('☆', 5 - $review->rating) }}</span>
                                                    </div>
                                                </div>

                                                <p class="text-gray-700">{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No reviews yet.</p>
                                    @endforelse
                                </div>
                            </div>
                            <div x-show="openTab === 4">
                                <ul>
                                    @forelse($relatedProducts->take(4) as $relatedProduct)
                                        <li>
                                            <div
                                                class="flex items-center gap-4 border-b border-dashed border-slate-900 py-4">
                                                <div>
                                                    <img src="{{ $relatedProduct->event_image ? '/storage/event_images/' . $relatedProduct->event_image : 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop' }}"
                                                        alt="{{ ucfirst($relatedProduct->event_title) }}"
                                                        class="w-28 h-auto rounded-xl" id="event_image" />
                                                </div>
                                                <div class="space-y-1">
                                                    <div class="ease-in duration-100 font-semibold hover:text-sky-500">
                                                        <a href="{{ route('event.show', $relatedProduct->slug) }}">
                                                            {{ $relatedProduct->event_title }}
                                                        </a>
                                                    </div>
                                                    <div class="text-sm">
                                                        {{ $relatedProduct->event_location }}
                                                    </div>
                                                    <div class="text-sm">
                                                        {{ date('d F Y', strtotime($relatedProduct->event_start_date)) }}
                                                    </div>
                                                    <div class="text-sm text-green-500 font-semibold">
                                                        IDR {{ number_format($product->event_price, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <div>There is no related product..</div>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aside -->
                <aside class="lg:sticky top-36 space-y-4 lg:col-span-4">
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

                        <a class="group relative block text-md font-bold text-black before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900 text-center"
                            href="/events?merchant={{ $product->merchant->id }}">
                            <div
                                class="h-full rounded-md border-2 border-slate-900 bg-white transition group-hover:-translate-y-2 group-hover:-translate-x-2">

                                <span class="relative block px-4 py-1"> More from {{ $product->merchant->user->name }}
                                </span>
                            </div>
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
                                        class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 bg-white p-4 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-slate-900 has-[:checked]:ring-1 has-[:checked]:ring-slate-500">
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
                                        IDR <span x-text="(productPrice * productQuantity).toLocaleString('id-ID')"></span>
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
                                            class="group relative block text-md font-bold text-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900 text-center">
                                            <div
                                                class="h-full rounded-md border-2 border-slate-900 bg-slate-900 transition group-hover:-translate-y-2 group-hover:-translate-x-2">

                                                <span class="relative block px-4 py-1"> Process to Checkout Page </span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        tippy('#event_image', {
            content: "{{ $product->event_title }}",
            followCursor: true,
            arrow: false,
        });
    </script>
@endpush

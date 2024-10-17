<li>
    <a {{ $attributes }}>
        <div
            class="group relative block h-full bg-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900">
            <div
                class="h-full rounded-md border-2 border-slate-900 bg-white transition group-hover:-translate-y-2 group-hover:-translate-x-2">
                <div class="p-4 sm:p-6">
                    <div class="mt-5">
                        <span aria-hidden="true" role="img" class="text-3xl sm:text-4xl">
                            <img src="{{ $product->event_image ? asset('storage/event_images/' . $product->event_image) : 'https://picsum.photos/id/' . rand(1, 100) . '/200/300' }}"
                                alt="{{ $product->event_title }}"
                                class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72" />
                        </span>
                        <div class="space-y-1">
                            <div class="flex items-center text-sm text-gray-700 mt-4">
                                <span>
                                    {{ $product->reviews->avg('rating') ? number_format($product->reviews->avg('rating'), 1) : 'No reviews yet' }}
                                </span>

                                @if ($product->reviews->avg('rating'))
                                    <div class="text-green-500 ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <h2 class="text-pretty text-lg font-medium text-gray-900 sm:text-xl">
                                {{ $product->event_title }}
                            </h2>
                            <p class="text-sm text-gray-700">
                                {{ date('d F Y', strtotime($product->event_start_date)) }}
                            </p>
                            <p class="text-sm text-gray-700">
                                {{ $product->event_location }}
                            </p>

                            <!-- Ambil harga ticket type reguler disini -->
                            @php
                                $regularTicket = $product->ticketTypes->firstWhere('type', 'Regular');
                            @endphp
                            <p class="text-lg font-medium text-[#F15C59]">
                                IDR
                                {{ $regularTicket ? number_format($regularTicket->price, 0, ',', '.') : 'Unavailable' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</li>

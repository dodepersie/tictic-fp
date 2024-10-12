<li>
    <a {{ $attributes }}>
        <div
            class="group relative block h-full bg-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900">
            <div
                class="h-full rounded-md border-2 border-slate-900 bg-white transition group-hover:-translate-y-2 group-hover:-translate-x-2">
                <div class="p-4 sm:p-6">
                    <div x-data class="mt-5"><span aria-hidden="true" role="img" class="text-3xl sm:text-4xl">
                            <img src="{{ $product->event_image ? '/storage/event_images/' . $product->event_image : 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop' }}"
                                alt="{{ $product->event_title }}"
                                class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72" />

                        </span>
                        <p class="mt-4 text-sm text-gray-700">
                            Rp {{ number_format($product->event_price, 0, ',', '.') }}
                        </p>
                        <h2 class="text-pretty text-lg font-medium text-gray-900 sm:text-xl">
                            {{ $product->event_title }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-700">
                            {{ $product->event_location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
</li>

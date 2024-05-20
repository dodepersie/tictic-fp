<li>
    <a {{ $attributes }} class="block rounded-lg p-4 border shadow-sm shadow-indigo-100">
        <img alt="Event thumbnail"
            src="https://images.unsplash.com/photo-1613545325278-f24b0cae1224?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
            class="h-56 w-full rounded-md object-cover" />

        <div class="mt-2">
            <dl>
                <div>
                    <dt class="sr-only">Price</dt>
                    <dd class="text-sm text-gray-500">Rp {{ number_format($product->event_price) }}</dd>
                </div>

                <div>
                    <dt class="sr-only">Event Name</dt>
                    <dd class="font-medium">{{ $product->event_title }}</dd>
                </div>

                <div>
                    <dt class="sr-only">Event Location</dt>
                    <dd class="text-sm text-gray-500">{{ $product->event_location }}</dd>
                </div>
            </dl>
        </div>
    </a>
</li>

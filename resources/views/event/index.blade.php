@extends('layouts.main')

@section('container')
    <section class="mx-auto max-w-screen-xl px-4 py-20 lg:px-8">
        <header class="mt-2 lg:mt-4">
            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">All Tickets on TicTic 😍🎉</h2>
        </header>

        <ul class="my-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($products as $product)
                <x-home-ticket href="/event/{{ $product->slug }}"><img alt="Event thumbnail"
                        src="https://images.unsplash.com/photo-1613545325278-f24b0cae1224?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                        class="h-56 w-full rounded-md object-cover" />

                    @slot('product', $product)
                </x-home-ticket>
            @endforeach
        </ul>

        {{ $products->links() }}
    </section>
@endsection

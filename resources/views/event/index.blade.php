@extends('layouts.main')

@section('container')
    <section>
        <header>
            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">All Tickets on TicTic 😍🎉</h2>
        </header>

        <ul class="my-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <x-home-ticket href="/event/{{ $product->slug }}">
                    @slot('product', $product)
                </x-home-ticket>
            @endforeach
        </ul>

        {{ $products->links() }}
    </section>
@endsection

@extends('layouts.main')

@section('container')
    <section>
        <header>
            <h2 class="text-3xl font-bold text-gray-900 leading-relaxed"> {{ $headingTitle }} 😍🎉</h2>
        </header>

        <div class="mt-4">
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

        {{ $products->links() }}
    </section>
@endsection

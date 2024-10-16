@extends('layouts.main')

@section('container')
    <section>
        <header>
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl leading-relaxed"> {{ $title }} 😍🎉</h2>
        </header>

        <div class="mt-4">
            @if ($categories->count())
                <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 my-4">
                    @foreach ($categories->sortBy('name') as $category)
                        <li>
                            <a href="/events?category={{ $category->slug }}">
                                <div
                                    class="group relative block h-full bg-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900">
                                    <div
                                        class="h-full rounded-md border-2 border-slate-900 bg-white transition group-hover:-translate-y-2 group-hover:-translate-x-2">
                                        <div class="p-4 sm:p-6">
                                            <div x-data class="mt-5">
                                                <span aria-hidden="true" role="img" class="text-3xl sm:text-4xl">
                                                    <img src="https://picsum.photos/id/{{ rand(1, 100) }}/200/300"
                                                        alt="{{ $category->name }}"
                                                        class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72" />
                                                </span>
                                                <h2 class="text-pretty text-lg font-medium text-gray-900 sm:text-xl mt-3">
                                                    {{ $category->name }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-md">
                    No categories available..
                </div>
            @endif
        </div>
    </section>
@endsection

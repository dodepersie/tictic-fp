@extends('layouts.main')

@section('container')
    <div class="comtainer mx-auto max-w-2xl">
        <div class="border border-dashed border-gray-300 p-3 flex flex-col items-center gap-2">
            <span class="text-lg">
                Checkout <span class="font-bold">{{ $transaction->product->event_title }}</span> successfully!
            </span>

            <a href="{{ route('dashboard_transactions.index') }}"
                class="group relative inline-block text-sm font-medium bg-white focus:outline-none focus:ring active:text-blue-500">
                <span class="absolute inset-0 border border-current"></span>
                <span
                    class="text-white block border border-current bg-blue-600 px-4 py-2 sm:py-2.5 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                    See details
                </span>
            </a>
        </div>
    </div>
@endsection

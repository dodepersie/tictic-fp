@extends('layouts.main')

@section('container')
    <div class="comtainer mx-auto max-w-2xl">
        <div class="border border-dashed border-gray-300 p-3 flex flex-col items-center gap-2">
            <span class="text-lg">
                Checkout <span class="font-bold">{{ $transaction->product->event_title }}</span> successfully!
            </span>

            <a href="{{ route('dashboard_transactions.index') }}"
                class="group relative block text-md font-bold text-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900 text-center">
                <div
                    class="h-full rounded-md border-2 border-slate-900 bg-slate-900 transition group-hover:-translate-y-2 group-hover:-translate-x-2">

                    <span class="relative block px-4 py-1"> View my transactions </span>
                </div>
            </a>
        </div>
    </div>
@endsection

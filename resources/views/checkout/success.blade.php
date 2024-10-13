@extends('layouts.main')

@section('container')
    <div class="comtainer mx-auto max-w-2xl">
        <div class="border border-dashed border-gray-300 p-3 flex flex-col items-center gap-2">
            <span class="text-lg">
                Checkout <span class="font-bold">{{ $transaction->product->event_title }}</span> successfully!
            </span>
        </div>
    </div>
@endsection

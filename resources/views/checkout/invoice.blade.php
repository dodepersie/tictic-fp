@extends('layouts.main')

@section('print-style')
    <style>
        @media print {
            .no-print {
                display: none;
            }

            .printable-area {
                display: block;
            }
        }
    </style>
@endsection

@section('container')
    <div class="comtainer mx-auto max-w-2xl">
        <div class="border border-dashed border-gray-300 p-6 pt-0 printable-area">
            <!-- Headaer -->
            <div class="flex justify-between items-center border-b-2 border-gray-200 py-2">
                <div class="text-2xl font-bold">INVOICE</div>
                <div class="flex justify-center items-center">
                    <div class="font-bold text-2xl">
                        @if ($transaction->status == 'Success')
                            <span class="text-green-600">PAID</span>
                        @endif
                        @if ($transaction->status == 'Pending')
                            <span class="text-yellow-600">UNPAID</span>
                        @endif
                        @if ($transaction->status == 'Canceled')
                            <span class="text-red-600">CANCELED</span>
                        @endif
                    </div>
                    <img src="{{ asset('/assets/img/TicTic Logo.png') }}" class="h-12 w-12" alt="TicTic Logo">
                </div>
            </div>

            <!-- Receipment Name, Date and Unique ID -->
            <div class="flex justify-between items-start pt-3">
                <div class="flex flex-col">
                    <span class="font-bold">For:</span>
                    <span>{{ $transaction->user->name }}</span>
                    <span>{{ $transaction->user->email }}</span>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="flex flex-col items-end">
                        <span class="font-bold">Date:</span>
                        <span>{{ $transaction->created_at->format('D, d F Y') }}</span>
                    </div>

                    <div class="flex flex-col items-end">
                        <span class="font-bold">Transaction Unique ID:</span>
                        <span>#{{ $transaction->unique_id }}</span>
                    </div>
                </div>
            </div>

            <!-- Order Table -->
            <div class="overflow-x-auto pt-7">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Unit Price</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Qty</th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                {{ $transaction->product->event_title }} {{ $transaction->ticketType->type }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">IDR
                                {{ number_format($transaction->ticketType->price, 0, ',', '.') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $transaction->quantity }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">IDR
                                {{ number_format($transaction->price, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-right" colspan="3">
                                Total
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">IDR
                                {{ number_format($transaction->price, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <!-- Notes -->
            <div class="flex justify-between items-start pt-3">
                <div class="flex flex-col">
                    <span class="font-bold">Notes:</span>
                    <span class="italic text-sm">Thank you for your trust in choosing TicTic</span>
                </div>
            </div>
        </div>

        @if ($transaction->status == 'Success')
            <button onclick="window.print()"
                class="mt-3 group relative block text-md font-bold text-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900 text-center w-full no-print">
                <div
                    class="h-full rounded-md border-2 border-slate-900 bg-slate-900 transition group-hover:-translate-y-2 group-hover:-translate-x-2">

                    <span class="relative block py-2"> Print Invoice </span>
                </div>
            </button>
        @endif

        @if ($transaction->status == 'Pending')
            <a href="{{ route('checkout', $transaction->id) }}"
                class="mt-3 group relative block text-md font-bold text-white before:absolute before:inset-0 before:rounded-md before:border-2 before:border-dashed before:border-slate-900 text-center w-full no-print">
                <div
                    class="h-full rounded-md border-2 border-slate-900 bg-slate-900 transition group-hover:-translate-y-2 group-hover:-translate-x-2">

                    <span class="relative block py-2"> Pay Now with Midtrans </span>
                </div>
            </a>
        @endif
    </div>
@endsection

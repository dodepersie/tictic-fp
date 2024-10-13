@extends('layouts.main')

@section('container')
    <div class="comtainer mx-auto max-w-2xl">
        <div class="border border-dashed border-gray-300 p-3 flex flex-col items-center gap-2">
            <span class="text-lg text-center">
                You will make payment to <span class="font-bold">{{ $transaction->product->event_title }}</span> of
                <span class="font-bold">Rp {{ number_format($transaction->price, 0, ',', '.') }}</span>
            </span>


            <button
                class="group relative inline-block text-sm font-medium bg-white focus:outline-none focus:ring active:text-blue-500"
                id="pay-button">
                <span class="absolute inset-0 border border-current"></span>
                <span
                    class="text-white block border border-current bg-blue-600 px-4 py-2 sm:py-2.5 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                    Pay now!
                </span>
            </button>
        </div>
    </div>
@endsection

@push('script')
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $transaction->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href = `{{ route('checkout-success', $transaction->id) }}`
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endpush

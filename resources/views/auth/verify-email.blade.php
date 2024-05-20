@extends('layouts.auth')

@section('auth_form')
    <div class="mx-auto max-w-lg text-center space-y-3">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold sm:text-3xl">TicTic</h1>
        </a>

        <div class="mx-auto mt-2 bg-teal-500 text-sm text-white rounded-lg p-4 max-w-lg" role="alert">
            <span class="leading-loose"><span class="font-bold">Success 🎉</span> Email verification has been sent, please
                check your email!</span>
        </div>

        <div class="flex justify-center items-center gap-2">
            <form action={{ route('verification.send') }} method="POST">
                @csrf
                <button type="submit"
                    class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                    <span class="absolute inset-0 border border-blue-600 group-active:border-blue-500"></span>
                    <span
                        class="block border border-blue-600 bg-blue-600 px-5 py-2 transition-transform active:border-blue-500 active:bg-blue-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                        Resend Email Verification
                    </span>
                </button>
            </form>

            <form action={{ route('logout') }} method="POST">
                @csrf
                <button type="submit"
                    class="group relative inline-block text-sm font-medium text-red-600 focus:outline-none focus:ring active:text-red-500">
                    <span class="absolute inset-0 border border-current"></span>
                    <span
                        class="block border border-current bg-white px-4 py-2 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                        Logout
                    </span>
                </button>
            </form>
        </div>
    </div>
@endsection

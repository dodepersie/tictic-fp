@extends('layouts.auth')

@section('auth_form')
    <div class="mx-auto max-w-lg text-center space-y-3">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold sm:text-3xl">TicTic</h1>
        </a>

        <h1 class="text-lg">Forgot Password</h1>

        @if ($errors->any())
            <div class="mx-auto flex bg-red-500 text-sm text-white rounded-lg p-4 max-w-md" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    @foreach ($errors->all() as $error)
                        <span class="font-medium">{{ $error }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session()->has('status'))
            <div class="mx-auto mt-2 bg-teal-500 text-sm text-white rounded-lg p-4 max-w-md" role="alert">
                <span class="font-bold">Success</span> {{ session()->get('status') }}
            </div>
        @endif
    </div>

    <form action="{{ route('password.email') }}" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
        @csrf
        <div>
            <label for="email" class="sr-only">Email</label>

            <div class="relative">
                <input id="email" name="email" value="{{ old('email') }}" type="email"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow"
                    placeholder="Enter your email address" autocomplete="off" autofocus required />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                    <i data-feather="at-sign" class="size-4 text-gray-400"></i>
                </span>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 underline">Back to Login Page</a>
            <button type="submit"
                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                <span class="absolute inset-0 border border-blue-600 group-active:border-blue-500"></span>
                <span
                    class="block border border-blue-600 bg-blue-600 px-5 py-2 transition-transform active:border-blue-500 active:bg-blue-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                    Send
                </span>
            </button>
        </div>
    </form>
@endsection

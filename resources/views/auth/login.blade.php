@extends('layouts.auth')

@section('auth_form')
    <div class="text-center space-y-3">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold sm:text-3xl">TicTic</h1>
        </a>

        <h1 class="text-lg">Log in to Dashboard</h1>

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

    @if (session()->has('success'))
        <div class="mt-4 space-y-5">
            <div class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Icon -->
                        <span
                            class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                        </span>
                        <!-- End Icon -->
                    </div>
                    <div class="ms-3">
                        <h3 class="text-gray-800 font-semibold">
                            Success
                        </h3>
                        <p class="text-sm text-gray-700 leading-loose">
                            {{ session()->get('success') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
        @csrf
        <div>
            <label for="email" class="sr-only">Email</label>

            <div class="relative">
                <input id="email" name="email" value="{{ old('email') }}" type="email"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Email"
                    autocomplete="off" @if (isset($_COOKIE['email'])) value="{{ $_COOKIE['email'] }}" @endif autofocus
                    required />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                    <i data-feather="at-sign" class="size-4 text-gray-400"></i>
                </span>
            </div>
        </div>

        <div x-data="{ showPassword: true }">
            <label for="password" class="sr-only">Password</label>

            <div class="relative">
                <input id="password" name="password" :type="showPassword ? 'password' : 'text'"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Password"
                    @if (isset($_COOKIE['password'])) value="{{ $_COOKIE['password'] }}" @endif required />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
                    <div @click="showPassword = !showPassword" :class="{ 'hidden': !showPassword, 'block': showPassword }">
                        <i data-feather="eye" class="size-4 text-gray-400"></i>
                    </div>
                    <div @click="showPassword = !showPassword" :class="{ 'block': !showPassword, 'hidden': showPassword }">
                        <i data-feather="eye-off" class="size-4 text-gray-400"></i>
                    </div>
                </span>
            </div>
        </div>

        <label for="remember_me" class="flex cursor-pointer items-start gap-2">
            <div class="flex items-center">
                &#8203;
                <input name="remember_me" type="checkbox" class="size-4 rounded border-gray-300" id="remember_me"
                    @if (isset($_COOKIE['password'])) checked="" @endif />
            </div>

            <div>
                <strong class="font-normal text-gray-500 text-sm"> Remember me </strong>
            </div>
        </label>

        <div class="text-sm text-gray-500">
            Forgot Password? <a href="/forgot-password" class="underline">Reset now</a>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3">
            <p class="text-sm text-gray-500">
                No account?
                <a class="underline" href="{{ route('register') }}">Register now!</a>
            </p>

            <div class="space-x-1.5">
                <button type="submit"
                    class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                    <span class="absolute inset-0 border border-blue-600 group-active:border-blue-500"></span>
                    <span
                        class="block border border-blue-600 bg-blue-600 px-5 py-2 transition-transform active:border-blue-500 active:bg-blue-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                        Log in
                    </span>
                </button>

                <a class="group relative inline-block text-sm font-medium text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                    href="/auth/google">
                    <span class="absolute inset-0 border border-current"></span>

                    <span
                        class="block border border-current bg-white px-4 py-2 transition-transform group-hover:-translate-x-1 group-hover:-translate-y-1">
                        Log in with Google </span>
                </a>
            </div>
        </div>
    </form>
@endsection

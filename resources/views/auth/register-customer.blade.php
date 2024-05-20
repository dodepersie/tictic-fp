@extends('layouts.auth')

@section('auth_form')
    <div class="mx-auto max-w-lg text-center space-y-3">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold sm:text-3xl">TicTic</h1>
        </a>

        <h1 class="text-lg">Register to TicTic</h1>
    </div>

    <div class="mx-auto mb-0 mt-4 max-w-md space-y-4">

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="flex-shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="m15 9-6 6"></path>
                            <path d="m9 9 6 6"></path>
                        </svg>
                    </div>
                    <div class="ms-4">
                        <h3 class="text-sm font-bold">
                            A problem has been occurred while submitting your data.
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc space-y-1 ps-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
            @csrf
            <div>
                <label for="email" class="sr-only">Email</label>

                <div class="relative">
                    <input type="email" name="email" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow"
                        placeholder="Email" value="{{ old('email') }}" autocomplete="off" autofocus required />

                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <i data-feather="at-sign" class="size-4 text-gray-400"></i>
                    </span>
                </div>
            </div>

            <div>
                <label for="name" class="sr-only">Full Name</label>

                <div class="relative">
                    <input id="name" name="name" type="text"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Full Name"
                        value="{{ old('name') }}" autocomplete="off" required />

                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <i data-feather="user" class="size-4 text-gray-400"></i>
                    </span>
                </div>
            </div>

            <div x-data="{ showPassword: true }">
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <input id="password" name="password" :type="showPassword ? 'password' : 'text'"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Password"
                        required />

                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
                        <div @click="showPassword = !showPassword"
                            :class="{ 'hidden': !showPassword, 'block': showPassword }">
                            <i data-feather="eye" class="size-4 text-gray-400"></i>
                        </div>
                        <div @click="showPassword = !showPassword"
                            :class="{ 'block': !showPassword, 'hidden': showPassword }">
                            <i data-feather="eye-off" class="size-4 text-gray-400"></i>
                        </div>
                    </span>
                </div>
            </div>

            <div>
                <label for="dob" class="sr-only">Date of Birth</label>

                <div class="relative">
                    <input id="dob" name="dob" type="date"
                        class="w-full rounded-lg border-gray-200 p-4 text-sm shadow" placeholder="DoB"
                        value="{{ old('date') }}" autocomplete="off" required />
                </div>
            </div>

            <fieldset class="flex flex-wrap items-center gap-3">
                <p class="text-sm text-gray-500">Select gender: </p>
                <legend class="sr-only">Gender</legend>

                <div>
                    <label for="Male"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 bg-white px-3 py-2 text-gray-900 hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500 has-[:checked]:text-white">
                        <input type="radio" name="gender" value="Male" id="Male" class="sr-only" required />

                        <p class="text-sm font-medium">Male</p>
                    </label>
                </div>

                <div>
                    <label for="Female"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 bg-white px-3 py-2 text-gray-900 hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500 has-[:checked]:text-white">
                        <input type="radio" name="gender" value="Female" id="Female" class="sr-only" required />

                        <p class="text-sm font-medium">Female</p>
                    </label>
                </div>
            </fieldset>

            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    Already have an account?
                    <a class="underline" href="{{ route('login') }}">Login now!</a>
                </p>

                <button type="submit"
                    class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                    <span class="absolute inset-0 border border-blue-600 group-active:border-blue-500"></span>
                    <span
                        class="block border border-blue-600 bg-blue-600 px-5 py-2 transition-transform active:border-blue-500 active:bg-blue-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                        Register
                    </span>
                </button>
            </div>
        </form>
    </div>
@endsection

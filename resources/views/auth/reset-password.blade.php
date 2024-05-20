@extends('layouts.auth')

@section('auth_form')
    <div class="mx-auto max-w-lg text-center space-y-3">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold sm:text-3xl">TicTic</h1>
        </a>

        <h1 class="text-lg">Reset Password</h1>

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
            <div class="mt-2 bg-teal-500 text-sm text-white rounded-lg p-4" role="alert">
                <span class="font-bold">Success</span> {{ session()->get('status') }}
            </div>
        @endif
    </div>

    <form action="{{ route('password.update') }}" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ request()->token }}" />
        <input type="hidden" name="email" value="{{ request()->email }}" />

        <div x-data="{ showPassword: true }">
            <label for="password" class="sr-only">Password</label>

            <div class="relative">
                <input id="password" name="password" :type="showPassword ? 'password' : 'text'"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Password" required />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
                    <svg class="size-4 text-gray-400" fill="none" @click="showPassword = !showPassword"
                        :class="{ 'hidden': !showPassword, 'block': showPassword }" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 576 512">
                        <path fill="currentColor"
                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                        </path>
                    </svg>

                    <svg class="size-4 text-gray-400" fill="none" @click="showPassword = !showPassword"
                        :class="{ 'block': !showPassword, 'hidden': showPassword }" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512">
                        <path fill="currentColor"
                            d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                        </path>
                    </svg>
                </span>
            </div>
        </div>

        <div x-data="{ showPassword: true }">
            <label for="password_confirmation" class="sr-only">Password</label>

            <div class="relative">
                <input id="password_confirmation" name="password_confirmation" :type="showPassword ? 'password' : 'text'"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="Confirm Password"
                    required />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
                    <svg class="size-4 text-gray-400" fill="none" @click="showPassword = !showPassword"
                        :class="{ 'hidden': !showPassword, 'block': showPassword }" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 576 512">
                        <path fill="currentColor"
                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                        </path>
                    </svg>

                    <svg class="size-4 text-gray-400" fill="none" @click="showPassword = !showPassword"
                        :class="{ 'block': !showPassword, 'hidden': showPassword }" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512">
                        <path fill="currentColor"
                            d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                        </path>
                    </svg>
                </span>
            </div>
        </div>

        <div class="float-end">
            <button type="submit"
                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                <span class="absolute inset-0 border border-blue-600 group-active:border-blue-500"></span>
                <span
                    class="block border border-blue-600 bg-blue-600 px-5 py-2 transition-transform active:border-blue-500 active:bg-blue-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                    Change Password
                </span>
            </button>
        </div>
    </form>
@endsection

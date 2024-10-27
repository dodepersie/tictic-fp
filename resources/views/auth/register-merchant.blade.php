@extends('layouts.auth')

@section('auth_form')

    <div class="mx-auto max-w-lg space-y-1">
        <div class="flex justify-center items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('/assets/img/TicTic Logo.png') }}" class="h-14 w-14 -mt-2" alt="TicTic Logo" />
            </a>
        </div>

        <h1 class="text-lg leading-loose text-center">
            Become our partner and start promoting your <span class="font-bold">SPECTACULAR</span> event! 😍🎉
        </h1>
    </div>

    <div class="mx-auto mb-0 mt-4 max-w-md">
        @if ($errors->any())
            <div class="mt-3 bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
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

        <form action="{{ route('register_merchant') }}" method="POST" class="mx-auto mb-0 mt-4 max-w-md space-y-4"
            enctype="multipart/form-data">
            @csrf
            <div class="relative">
                <label for="name" class="sr-only">Merchant Name</label>

                <input type="text" id="name" name="name"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="PT. Tiket Indonesia"
                    value="{{ old('name') }}" autofocus autocomplete="off" />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                    <i data-feather="user" class="size-4 text-gray-400"></i>
                </span>
            </div>

            <div class="relative">
                <label for="email" class="sr-only">Email</label>

                <input type="email" id="Email" name="email"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" placeholder="tiket@tictic.id"
                    value="{{ old('email') }}" autocomplete="off" />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                    <i data-feather="at-sign" class="size-4 text-gray-400"></i>
                </span>
            </div>

            <div class="relative">
                <label for="phone_number" class="sr-only">Phone Number</label>

                <input type="tel" id="phone_number" name="phone_number"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" pattern="\+62\d{10,12}"
                    placeholder="+62" value="{{ old('phone_number') }}" autocomplete="off" />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                    <i data-feather="phone" class="size-4 text-gray-400"></i>
                </span>
            </div>

            <div>
                <label for="company_description" class="sr-only">Company Description</label>

                <textarea id="company_description" name="company_description"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow resize-none" rows="4" cols="50"
                    placeholder="Tell something about your company..">{{ old('company_description') }}</textarea>
            </div>

            <!-- Upload Document -->
            <div class="space-y-5">
                <h1 class="text-xs text-gray-500">Merchant Documents</h1>
                <label for="document" class="sr-only">Upload Document</label>
                <input type="file" id="document" name="document"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow" />
                <p class="text-xs text-gray-500">*Please upload .pdf file with maximum size of 2MB</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    By creating an account, you agree to our
                    <a href="#" class="text-gray-700 underline"> terms and conditions </a>
                    and
                    <a href="#" class="text-gray-700 underline">privacy policy</a>.
                </p>
            </div>

            <div class="col-span-6 sm:flex sm:flex-wrap sm:items-center sm:gap-4">
                <button type="submit"
                    class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                    <span class="absolute inset-0 border border-blue-600 group-active:border-blue-500"></span>
                    <span
                        class="block border border-blue-600 bg-blue-600 px-5 py-2 transition-transform active:border-blue-500 active:bg-blue-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                        Create a Merchant Account
                    </span>
                </button>

                <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-gray-700 underline">Log in</a>.
                </p>
            </div>
        </form>
    </div>
@endsection

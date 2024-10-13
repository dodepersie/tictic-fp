@extends('layouts.error', ['title' => '403 Forbidden!'])

@section('container')
    <div
        class="space-y-5 w-full bg-white dark:bg-gray-800 p-4 flex flex-col justify-center items-center mx-auto min-h-screen">
        <img src="https://digiconceptng.com/storage/2022/02/403-forbidden-error.jpg" alt="403 Forbidden" />
        <h1 class="text-5xl font-extrabold dark:text-white">403!</h1>
        </h1>

        <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400 lg:text-left mb-5">
            Sorry, your access is forbidden. {{ $exception->getMessage() }} Please contact the administrator! 😅
        </p>

        <button onclick="window.history.back()"
            class="inline-flex justify-center items-center px-3.5 py-2 my-5 text-base font-medium text-center text-gray-50 bg-blue-700 dark:bg-slate-900 dark:hover:bg-slate-900/50 rounded-lg hover:bg-blue-600/90">
            <svg class="w-5 h-5 mr-2 rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            Back
        </button>
    </div>
@endsection

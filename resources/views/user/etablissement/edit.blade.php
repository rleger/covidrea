@extends('layouts.app')

@section('page_title', "Edition de l'établissement")

@section('content')
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <form action="" method="POST">
            @method('PATCH')
            @csrf
            <div class="px-4 py-5 text-lg leading-6 font-medium text-indigo-600 sm:px-6">
                {{ $etablissement->name }}
            </div>
            <div class="px-4 pb-8">
                <div class="border-t border-gray-200">
                    <div class="mt-6 sm:mt-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                            <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                First name
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <input id="first_name" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="last_name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Last name
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <input id="last_name" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Email address
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-lg rounded-md shadow-sm">
                                    <input id="email" type="email" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="country" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Country / Region
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <select id="country" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>Mexico</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="street_address" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Street address
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-lg rounded-md shadow-sm">
                                    <input id="street_address" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="city" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                City
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <input id="city" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="state" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                State / Province
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <input id="state" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="zip" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                ZIP / Postal
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <input id="zip" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>











            </div>
            <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                        {{ __('Save') }}
                    </button>
                </span>
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-50 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-200 transition ease-in-out duration-150">
                        {{ __('Cancel') }}
                    </button>
                </span>
            </div>
        </form>
    </div>
@endsection

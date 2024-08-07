<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center content-center">
            <h2 class="font-semibold pt-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Welkom, ') . Auth::user()->first_name . ' ' . Auth::user()->last_name . ('.') }}
            </h2>
            <a class="bg-tsaam-500 px-2 no-underline rounded border-tsaam-700 border text-white mt-2 md:mt-0"
               href="{{ route('shoppingCart') }}">
                <div class="flex flex-row items-center">
                    <p class="bg-tsaam-600 rounded-full mt-2 px-2">
                        @if(session()->has('myCount'))
                            {{ session()->get('myCount') }}
                        @else
                            {{ 0 }}
                        @endif
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-10 h-6 fill-white">
                        <path
                            d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16z"/>
                    </svg>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Page content-->
                    <div class="flex flex-col md:flex-row justify-between content-center text-center items-center">
                        <h2 class="text-2xl mb-4 md:mb-0">Om door te gaan, selecteer een kind of voeg een nieuwe toe.</h2>
                        <a href="{{ route('addchild')  }}"
                           class="flex items-center text-white text-decoration-none me-5 fill-white no-underline text-white bg-tsaam-500 hover:bg-tsaam-700 focus:outline-none focus:ring-4 focus:ring-tsaam-300 font-medium rounded-full text-sm px-4 py-2.5 text-center mb-2 md:mb-0">
                            Voeg toe
                            <svg class="ps-2 text-white" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach(Auth::user()->children as $child)
                            <div class="flex flex-col w-full sm:w-1/2 lg:w-1/3 max-w-sm">
                                <div class="flex h-full flex-col m-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a href="{{ route('productList', ['childId' => $child->id]) }}">
                                        <img class="rounded-t-lg p-3 w-full"
                                             @if($child->profile_photo_path) src="{{ $child->profile_photo_path }}"
                                             @else src="{{ asset('build/assets/images/children/1.jpg') }}"
                                             @endif alt="child picture"/>
                                    </a>
                                    <div class="p-3 flex h-full justify-between flex-col">
                                        <div class="mb-3">
                                            <div class="flex flex-row justify-between">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    {{ $child->first_name . ' ' . $child->last_name }}</h5>
                                                <a href="{{ route('editchild', $child->id) }}" wire:navigate
                                                   type="button"
                                                   class="flex items-center text-white text-decoration-none fill-white no-underline bg-tsaam-500 hover:bg-tsaam-700 focus:outline-none focus:ring-4 focus:ring-tsaam-300 font-medium rounded-full text-sm px-2 py-2.5 text-center me-2 mb-2 dark:bg-tsaam-500 dark:hover:bg-tsaam-600 dark:focus:ring-tsaam-700">
                                                    <svg class="rtl:rotate-180 w-3 h-3 mx-2 text-white"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path
                                                            d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $child->studiekeuze->name }}</p>
                                        </div>
                                        <a href="{{ route('productList', ['childId' => $child->id]) }}" wire:navigate type="button"
                                           class="flex items-center text-white text-decoration-none fill-white no-underline text-white bg-tsaam-500 hover:bg-tsaam-700 focus:outline-none focus:ring-4 focus:ring-tsaam-300 font-medium rounded-full text-sm px-4 py-2.5 text-center me-5 mb-2 dark:bg-tsaam-500 dark:hover:bg-tsaam-600 dark:focus:ring-tsaam-700">
                                            Selecteer en ga verder
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

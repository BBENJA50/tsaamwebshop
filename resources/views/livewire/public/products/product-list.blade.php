<x-slot name="header">
    <div class="flex flex-row justify-between items-center content-center py-0 my-0">
        <div>
            <div class="flex flex-row">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 sm:size-6 ">
                    <path
                        d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 73.4-73.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-128 128z"/>
                </svg>
                <a href="{{ route('home') }}" class="no-underline ms-3 text-tsaam-500 hover:text-tsaam-600">Terug naar
                    kinderen</a></div>
            <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-0">
                @if($child)
                    {{ $child->first_name }} {{ $child->last_name }} - {{ $child->studiekeuze->name }}
                @else
                    {{ __('Geen kind geselecteerd') }}
                @endif
            </p>
        </div>

        <p class="bg-tsaam-500 px-4 py-2 rounded text-white m-0">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-10 h-10 fill-white">
                <path
                    d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
            </svg>
        </p>
    </div>
</x-slot>
<div>
    <div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2 pb-16">
        <div class="col-start-2 col-span-6">
            <div class="grid grid-cols-7 gap-4">
                <div class="col-span-2">
                    <div class="relative shadow-md sm:rounded-lg">
                        <div class="bg-white p-4 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg sm:rounded-lg">
                            <p class="text-xl font-semibold border-b-4 border-tsaam-500 rounded text-center mb-10">
                                FILTERS</p>
                            <div class="mb-4">Vakken</div>
                            <h3 class="text-xl font-semibold mb-4">{{ __('Categorieën') }}</h3>
                            <ul>
                                <li>
                                    <a href="#" wire:click.prevent="filterByCategory(null)"
                                       class="{{ $category_id ? '' : 'font-bold' }}">{{ __('Alle categorieën') }}</a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="#" wire:click.prevent="filterByCategory({{ $category->id }})"
                                           class="{{ $category_id === $category->id ? 'font-bold' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mb-4">Nog iets
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-5">
                    <div class="relative shadow-md sm:rounded-lg">
                        <div class="bg-white p-4 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg sm:rounded-lg">
                            @if(Auth::user()->hasRole('admin'))
                                <h3 class="text-xl font-semibold border-b-4 border-tsaam-500 rounded text-center mb-10">{{ __('Alle producten') }}</h3>
                            @else
                                @if($child)
                                    <h3 class="text-xl font-semibold text-center">{{ $child->studiekeuze->name }}</h3>
                                @else
                                    <h3 class="text-xl font-semibold border-b-4 border-tsaam-500 rounded text-center mb-10">{{ __('Geen kind geselecteerd') }}</h3>
                                @endif
                            @endif
                            <div class="flex flex-wrap justify-start">
                                @forelse($products as $product)
                                    <div class="w-1/4">
                                        <livewire:public.products.product-card :product="$product" :child="$child"/>
                                    </div>
                                @empty
                                    <p>{{ __('Geen producten gevonden.') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

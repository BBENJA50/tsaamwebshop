<x-slot name="header">
    <div class="flex flex-row justify-between items-center content-center py-0 my-0">
        <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-0">
            @if($child)
                {{ $child->studiekeuze->name }}
            @else
                {{ __('Geen kind geselecteerd') }}
            @endif
        </p>
        <p class="bg-tsaam-500 px-4 py-2 rounded text-white m-0">Winkelmand hier?</p>
    </div>
</x-slot>
<div>
    <div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2 pb-16">
        <div class="col-start-2 col-span-6">
            <div class="grid grid-cols-7 gap-4">
                <div class="col-span-2">
                    <div class="relative shadow-md sm:rounded-lg">
                        <div class="bg-white p-4 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg sm:rounded-lg">
                            <p class="text-xl font-semibold border-b-4 border-tsaam-500 rounded text-center mb-10">FILTERS</p>
                            <div class="mb-4">Vakken</div>
                            <h3 class="text-xl font-semibold mb-4">{{ __('Categorieën') }}</h3>
                            <p>niet op klikken, werkt nog niet goed</p>
                            <ul>
                                <li>
                                    <a href="#" wire:click.prevent="filterByCategory(null)" class="{{ $category_id ? '' : 'font-bold' }}">{{ __('Alle categorieën') }}</a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="#" wire:click.prevent="filterByCategory(1)"
                                           class="{{ $category_id === $category->id ? 'font-bold' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mb-4">Nog iets</div>
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
                                        <livewire:public.products.product-card :product="$product" :child="$child" />
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

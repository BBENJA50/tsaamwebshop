<!-- resources/views/livewire/admin/products/product-list.blade.php -->

<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex flex-row justify-between items-center p-4 bg-white dark:bg-gray-800">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Producten</h2>
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                        Hier vind je alle producten. Voeg toe, bewerk of verwijder.
                    </p>
                </div>
                <input type="text" wire:model.live="search" placeholder="Zoek product..."
                       class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"/>
                <div>
                    <a href="{{ route('addproduct') }}" wire:navigate type="button"
                       class="fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center ms-4 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                        <svg class="text-white" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path
                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="ps-6 py-3">Foto</th>
                    <th scope="col" class="ps-6 py-3 cursor-pointer" wire:click="sortBy('name')">
                        Naam
                        @if($sortField === 'name')
                            <svg class="inline w-4 h-4 ml-1 {{ $sortDirection === 'asc' ? 'transform rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 001.414 0L10 6.414l3.293 3.293a1 1 0 001.414-1.414l-4-4a1 1 0 00-1.414 0l-4 4a1 1 0 000 1.414z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </th>
                    <th scope="col" class="px-3 py-3 cursor-pointer" wire:click="sortBy('description')">
                        Omschrijving
                        @if($sortField === 'description')
                            <svg class="inline w-4 h-4 ml-1 {{ $sortDirection === 'asc' ? 'transform rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 001.414 0L10 6.414l3.293 3.293a1 1 0 001.414-1.414l-4-4a1 1 0 00-1.414 0l-4 4a1 1 0 000 1.414z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3">Categorie</th>
                    <th scope="col" class="px-6 py-3">Vak</th>
                    <th scope="col" class="px-6 py-3">Studiekeuze</th>
                    <th scope="col" class="px-6 py-3">Attributen</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="ps-2 py-4">
                            <img @if($product->image) @if(Storage::exists('public/images/' . $product->image)) src="{{ asset('storage/public/images/' . $product->image) }}" @else src="{{ $product->image }}" @endif
                            @else src="{{ asset('build/assets/images/products/' . mt_rand(0,9) . '.jpg') }}"
                                 @endif alt="{{ $product->name }}" class="w-20 h-20">
                        </td>
                        <th scope="row"
                            class="ps-6 py-4 font-extrabold text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->name }}
                        </th>
                        <td class="px-3 py-4">
                            {{ $product->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ optional($product->subject)->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if(count($product->studiekeuzes) > 3)
                                <ul class="overflow-y-scroll px-0 mx-0 h-20">
                                    @foreach($product->studiekeuzes as $studiekeuze)
                                        <li class="px-0 mx-0">{{ $studiekeuze->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="px-0 mx-0 h-20">
                                    @foreach($product->studiekeuzes as $studiekeuze)
                                        <li class="px-0 mx-0">{{ $studiekeuze->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->attribute->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->price }}
                        </td>
                        <td class="px-6 py-4 text-right flex justify-end">
                            <a href="{{ route('editproduct', ['id' => $product->id]) }}"
                               class="px-2 font-medium no-underline text-blue-400 dark:text-blue-500 hover:underline hover:text-orange-500">Bewerken</a>
                            <a href="#" wire:click="delete({{ $product->id }})" wire:confirm="Ben je zeker dat je {{ $product->name }} wilt verwijderen?"
                               class="px-2 font-medium text-blue-600 dark:text-blue-500 hover:underline text-right object-right flex inline-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-red-700" viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <p>Geen producten gevonden</p>
                @endforelse
                </tbody>
            </table>
            <div class="bg-white p-2 px-4 border-b dark:bg-gray-800">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

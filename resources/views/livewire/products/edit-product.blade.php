<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="flex flex-row">
                    <div
                        class="p-4 basis-5/6 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Product bewerken
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            Bewerk een product.
                        </p>
                    </div>
                    <div
                        class="basis-1/6 p-4 text-sm font-normal text-right rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 align-middle content-center">
                        <a href="{{ route('producten') }}" wire:navigate type="button"
                           class="text-white text-decoration-none fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center me-2 mb-2 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                            Terug
                        </a>

                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow sm:px-8 sm:py-6 sm:w-full ">
                    <form method="POST" wire:submit.prevent="update" class="max-w-xl mx-auto">
                        @csrf
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="naam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Naam</label>
                            <input wire:model="name" value=" {{ $name }}" type="text" id="naam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beschrijving</label>
                            <textarea wire:model="description" value=" {{ $description }}" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prijs</label>
                            <input wire:model="price" value=" {{ $price }}" step="0.01" type="number" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorie</label>
                            <select wire:model="category_id" id="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                <option value="Selecteer een categorie" selected disabled>Selecteer een categorie.</option>
                                @foreach( $categories as $category)
                                    <option {{ $category->id == $product->category->id ? 'selected' : ''}} value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="kleuren" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kleuren</label>
                                <div class="flex items-center me-4">
                                    <input id="red-checkbox" type="checkbox" value="" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Rood</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="green-checkbox" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="green-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Groen</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="purple-checkbox" type="checkbox" value="" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="purple-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Paars</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="teal-checkbox" type="checkbox" value="" class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="teal-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Groenblauw</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="yellow-checkbox" type="checkbox" value="" class="w-4 h-4 text-yellow-400 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="yellow-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Geel</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="orange-checkbox" type="checkbox" value="" class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="orange-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Oranje</label>
                                </div>

                            </div>
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="maten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maten</label>

                                <div class="flex items-center me-4">
                                    <input id="red-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">XS</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="red-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">S</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="red-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">M</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="red-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">L</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="red-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">XL</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="red-checkbox" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="red-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">XXL</label>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">Versturen</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

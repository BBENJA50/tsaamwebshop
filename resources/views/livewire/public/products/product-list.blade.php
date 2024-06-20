<div>
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-2 mb-2 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center content-center py-0 my-0">
                <div class="mb-2 md:mb-0">
                    <div class="flex flex-row">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path
                                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 73.4-73.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-128 128z"/>
                        </svg>
                        <a href="{{ route('home') }}" class="no-underline ms-3 text-tsaam-500 hover:text-tsaam-600">Terug
                            naar
                            kinderen</a>
                    </div>
                    <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-0">
                        @if($child)
                            {{ $child->first_name }} {{ $child->last_name }} - {{ $child->studiekeuze->name }}
                        @else
                            {{ __('Geen kind geselecteerd') }}
                        @endif
                    </p>
                </div>
                <a class="bg-tsaam-500 px-2 no-underline rounded border-tsaam-700 border text-white m-0"
                   href="{{ route('shoppingCart') }}">
                    <div class="flex flex-row items-center">
                        <p class="bg-tsaam-600 rounded-full mt-2 px-2">{{ $myCount }}</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-10 h-6 fill-white">
                            <path
                                d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"/>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div>
        <div id="exampleWrapper" class="overflow-hidden grid grid-cols-1 lg:grid-cols-8 gap-4 pt-2 pb-16">
            <div class="col-start-1 lg:col-start-2 col-span-1 lg:col-span-6">
                <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
                    <div class="col-span-1 md:col-span-2">
                        <div class="relative shadow-md sm:rounded-lg">
                            <div
                                class="bg-white p-4 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg sm:rounded-lg">
                                <p class="text-xl font-semibold border-b-4 border-tsaam-500 rounded text-center mb-10">
                                    FILTERS
                                </p>
                                <div class="mb-4">Vakken</div>
                                <h3 class="text-xl font-semibold mb-4">{{ __('Categorieën') }}</h3>
                                @foreach($categories as $category)
                                    <div class="mb-4">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="category_id" id="category_id"
                                                   class="form-checkbox text-tsaam-500 focus:ring-tsaam-500"
                                                   wire:model.live="category_id" value="{{ $category->id }}">
                                            <span class="ml-2">{{ $category->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="mt-4 flex rounded items-center text-center content-center align-middle bg-blue-500 text-white text-sm font-bold px-4 py-3"
                            style="display: none"
                            x-data="{show : false}"
                            x-show="show"
                            x-transition
                            x-init="@this.on('added', () => {
                             show = true;
                             setTimeout(() => {show = false;}, 2000)
                         })">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                            </svg>

                            <p class="m-0 p-0">{{ session('message') }}</p>

                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-5">
                        <div class="relative shadow-md sm:rounded-lg">
                            <div
                                class="bg-white p-4 dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg sm:rounded-lg">
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

                                    @foreach($products as $product)
                                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4" wire:key="{{ $product->id }}">
                                            <div class="p-3 flex h-full justify-between flex-col">
                                                <div
                                                    class="flex h-full flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                    <img class="rounded-t-lg h-40 object-contain"
                                                         @if( $product->image) @if( Storage::exists('public/images/' . $product->image)) src="{{ asset('storage/public/images/' . $product->image) }}"
                                                         @else src="{{ $product->image  }}" @endif
                                                         @else src="{{ asset('build/assets/images/products/'. mt_rand(0,9) . '.jpg') }}"
                                                         @endif alt="{{ $product->name }}"/>
                                                    <div class="p-3 pt-1 h-full flex flex-col justify-between">
                                                        <div>
                                                            <p class="mb-2 font-normal text-xs text-gray-700 dark:text-gray-400">{{$product->category->name }}</p>
                                                            <h5 class=" text-xl font-bold no-underline  text-gray-900 dark:text-white">{{$product->name}}</h5>
                                                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->description}}</p>
                                                        </div>
                                                        <div>
                                                            @if (isset($productErrors[$product->id]))
                                                                <p class="text-red-500 text-xs mt-1">{{ $productErrors[$product->id] }}</p>
                                                            @endif
                                                            <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">
                                                                € {{$product->price}} </p>

                                                            <div class="flex flex-row">
                                                                <div class="flex flex-row justify-between w-full">
                                                                    <div class="flex items-end">
                                                                        <button
                                                                            wire:click="addProductToCart({{ $product->id }})"
                                                                            class="inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-tsaam-500 rounded-lg hover:bg-tsaam-600 focus:ring-4 focus:outline-none focus:ring-tsaam-300 dark:bg-tsaam-600 dark:hover:bg-tsaam-700 dark:focus:ring-tsaam-800">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 class="h-6 w-5 fill-white"
                                                                                 viewBox="0 0 576 512">
                                                                                <path
                                                                                    d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32H360V134.1l23-23c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-64 64c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l23 23V32H120.1C111 12.8 91.6 0 69.5 0H24zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"/>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="items-center w-full ms-2">
                                                                        @if($product->attribute_id > 1)
                                                                            <div class="w-full">
                                                                                <select
                                                                                    id="attribute_{{ $product->id }}"
                                                                                    wire:model="selectedAttributeOptions.{{ $product->id }}"
                                                                                    class="form-select mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                                                    <option
                                                                                        value="">{{ __('Maat') }}</option>
                                                                                    @foreach($product->attribute->attributeOptions as $option)
                                                                                        <option
                                                                                            value="{{ $option->value }}">{{ $option->value }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

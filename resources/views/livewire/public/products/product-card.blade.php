<div class="p-3 flex h-full justify-between flex-col">
    <div
        class="flex h-full flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="rounded-t-lg h-48"
                 @if( $product->image) src="{{ asset('storage/public/images/' . $product->image) }}"
                 @else src="{{ asset('build/assets/images/products/'. mt_rand(0,9) . '.jpg') }}"
                 @endif alt="{{ $product->name }}"/>
        </a>
        <div class="p-3 pt-1 h-full flex flex-col justify-between">
            <div>
                <p class="mb-2 font-normal text-xs text-gray-700 dark:text-gray-400">{{$category->name }}</p>
                <div class="flex flex-row justify-between">
                    <a href="#" class="no-underline">
                        <h5 class=" text-xl font-bold no-underline  text-gray-900 dark:text-white">{{$product->name}}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->price}}€</p>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->description}}</p>
            </div>
            <div class="flex flex-row justify-between items-end">
                <div>
                    <a href="#" wire:click="addToCart({{ $product->id }}, $refs.attributes ? $refs.attributes.value : null)"
                       class="inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-tsaam-500 rounded-lg hover:bg-tsaam-600 focus:ring-4 focus:outline-none focus:ring-tsaam-300 dark:bg-tsaam-600 dark:hover:bg-tsaam-700 dark:focus:ring-tsaam-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 fill-white" viewBox="0 0 576 512">
                            <path
                                d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32H360V134.1l23-23c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-64 64c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l23 23V32H120.1C111 12.8 91.6 0 69.5 0H24zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"/>
                        </svg>
                    </a>
                </div>
                @if($attribute->id != '1')
                    <form class="w-full ms-2">
                        <select id="attributes" x-ref="attributes"
                                class="w-full bg-gray-50 border border-tsaam-300 text-tsaam-900 text-xs rounded-lg focus:ring-tsaam-500 focus:border-tsaam-500 block p-2.5 dark:bg-tsaam-700 dark:border-tsaam-600 dark:placeholder-tsaam-400 dark:text-white dark:focus:ring-tsaam-500 dark:focus:border-tsaam-500">
                            <option selected>Kies een optie</option>
                            @foreach($attribute->attributeOptions as $attributeOption)
                                <option class="w-full"
                                        value="{{ $attributeOption->value }}">{{ $attributeOption->value }}</option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="flex flex-row">
                    <div
                        class="p-4 basis-5/6 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Producten
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            Hier vind je alle producten. Voeg toe, bewerk of verwijder.
                        </p>
                    </div>
                    <div
                        class="basis-1/6 p-4 text-sm font-normal text-right rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 align-middle content-center">
                        <a href="{{ route('addproduct') }}" wire:navigate type="button"
                           class="fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center me-2 mb-2 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                            <svg class="text-white" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 448 512">
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Naam
                    </th>
                    <th scope="col" class="px-6 py-3">
                        omschrijving
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kleuren
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse( $products as $product )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="ps-6  py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->name }}
                        </th>
                        <td class="px-3 py-4">
                            {{ $product->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->category }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->kleur }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->price }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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

<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-3 col-span-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="flex flex-row">
                    <div
                        class="p-4 basis-5/6 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Categorieën
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            Hier vind je alle categorieën. Voeg toe, bewerk of verwijder.
                        </p>
                    </div>
                    <div
                        class="basis-1/6 p-4 text-sm font-normal text-right rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 align-middle content-center">
                        <a href="{{ route('addcategory') }}" wire:navigate type="button"
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
                    <th scope="col" class="px-2 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    <th scope="col" class="px-2 py-3">
                        <span class="sr-only">Delete</span>
                    </th>

                </tr>
                </thead>
                <tbody>
                @forelse( $categories as $category )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="ps-6  py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->name }}
                        </th>
                        <td class="px-2 py-3 text-right">
                            <a href=" {{ route('editcategory', $category) }}"
                               class="font-medium no-underline text-gray-500 dark:text-blue-500 hover:underline hover:text-gray-900">Bewerken</a>
                        </td>
                        <td class="pe-4 py-3 text-right">
                            <a wire:click="delete({{ $category->id }})" wire:confirm="Ben je zeker dat je {{ $category->name }} wilt verwijderen?" href="#"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-right object-right flex inline-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-red-700" viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <p>Geen categorieën gevonden</p>
                @endforelse
                </tbody>
            </table>
            <div class="bg-white p-2 px-4 border-b dark:bg-gray-800">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

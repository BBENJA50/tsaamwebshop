<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div class="flex flex-row justify-between items-center p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="text-lg font-semibold text-left rtl:text-right text-gray-900 dark:text-white">
                    Richtingen
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                        Hier vind je alle richtingen. Voeg toe, bewerk of verwijder.
                    </p>
                </div>
                <input type="text" wire:model.live="search" placeholder="Zoek richting..."
                       class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"/>

                <div class="flex items-center">
                    <a href="{{ route('addstudyfield') }}" wire:navigate type="button"
                       class="fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center ms-4 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                        <svg class="text-white" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" wire:click="sortByName" class="ps-6 py-3 cursor-pointer">
                            Naam
                            @if ($sortDirection === 'asc')
                            <span>&uarr;</span>
                            @else
                            <span>&darr;</span>
                            @endif
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($studyfields as $studyfield)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="ps-6  py-4 font-extrabold text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $studyfield->name }}
                        </th>
                        <td class="px-6 py-4 text-right flex justify-end">
                            <a href="#" wire:click="delete({{ $studyfield->id }})" wire:confirm="Ben je zeker dat je {{ $studyfield->name }} wilt verwijderen?"
                               class="px-2 font-medium text-blue-600 dark:text-blue-500 hover:underline text-right object-right flex inline-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-red-700" viewBox="0 0 448 512">
                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center">Geen richtingen gevonden</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="bg-white p-2 px-4 border-b dark:bg-gray-800">
                {{ $studyfields->links() }}
            </div>
        </div>
    </div>
</div>

<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="flex flex-row">
                    <div
                        class="p-4 basis-5/6 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Kinderen
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            Hier vind je alle Kinderen. Voeg toe, bewerk of verwijder.
                        </p>
                    </div>
                    <div
                        class="basis-1/6 p-4 flex-row text-sm font-normal text-right rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 align-middle content-center">
                        <a href="{{ route('addchild') }}" wire:navigate type="button"
                           class="fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center me-2 mb-2 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                            <svg class="text-white" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path
                                    d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
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
                        Studierichting
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ouder/voogd
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($children as $child)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $child->first_name }} {{ $child->last_name }}
                        </th>
                        <td class="px-6 py-4">
                            @if($child->studiekeuze != NULL)
                                {{ $child->studiekeuze->name }}
                            @else
                                Geen studierichting
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($child->user != NULL)
                                {{ $child->user->first_name }} {{ $child->user->last_name }}
                            @else
                                Geen ouder/voogd
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $child-> is_active == 1 ? 'Actief' : 'Inactief' }}
                        </td>
                        <td class="px-6 py-4 text-right justify-end flex">
                            <a  href=" {{ route('editchild', $child->id) }}" class="px-2 font-medium no-underline text-blue-600 dark:text-blue-500 hover:underline">Bewerken</a>
                            @if($child->deleted_at != NULL)
                                {{-- Restore deleted child--}}
                                <a href="#" wire:click="restore({{ $child->id }})"  class="px-2 font-medium no-underline text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-orange-700" viewBox="0 0 512 512">
                                        <path d="M125.7 160H176c17.7 0 32 14.3 32 32s-14.3 32-32 32H48c-17.7 0-32-14.3-32-32V64c0-17.7 14.3-32 32-32s32 14.3 32 32v51.2L97.6 97.6c87.5-87.5 229.3-87.5 316.8 0s87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3s-163.8-62.5-226.3 0L125.7 160z"/></svg>
                                </a>
                            @else
                                <a  href="#" wire:click="delete({{ $child->id }})" wire:confirm="Ben je zeker dat je {{ $child->first_name }} {{ $child->last_name }} wilt verwijderen?"
                                    class="px-2 font-medium text-blue-600 dark:text-blue-500 hover:underline text-right object-right flex inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-red-700" viewBox="0 0 448 512">
                                        <path
                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                    </svg>
                                </a>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Geen Kinderen gevonden
                        </th>
                        <td class="px-6 py-4">
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            {{ $children->links() }}
        </div>
    </div>
</div>

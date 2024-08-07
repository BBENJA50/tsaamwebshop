<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex flex-row justify-between items-center p-4 bg-white dark:bg-gray-800">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Gebruikers</h2>
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                        Hier vind je alle gebruikers. Voeg toe, bewerk of verwijder.
                    </p>
                </div>
                <input type="text" wire:model.live="search" placeholder="Zoek gebruiker..."
                       class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"/>
                <div>
                    <a href="{{ route('adduser') }}" wire:navigate type="button"
                       class="fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center ms-4 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                        <svg class="text-white" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 640 512">
                            <path
                                d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('first_name')">
                        Naam
                        @if($sortField === 'first_name')
                            <svg class="inline w-4 h-4 ml-1 {{ $sortDirection === 'asc' ? 'transform rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 001.414 0L10 6.414l3.293 3.293a1 1 0 001.414-1.414l-4-4a1 1 0 00-1.414 0l-4 4a1 1 0 000 1.414z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('email')">
                        Email adres
                        @if($sortField === 'email')
                            <svg class="inline w-4 h-4 ml-1 {{ $sortDirection === 'asc' ? 'transform rotate-180' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 001.414 0L10 6.414l3.293 3.293a1 1 0 001.414-1.414l-4-4a1 1 0 00-1.414 0l-4 4a1 1 0 000 1.414z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3">GSM nummer</th>
                    <th scope="col" class="px-6 py-3">Kinderen</th>
                    <th scope="col" class="px-6 py-3">Rollen</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->gsm_number }}
                        </td>
                        <td>
                            @if(count($user->children) > 0)
                                @foreach($user->children as $child)
                                    <p>{{ $child->first_name }} {{ $child->last_name }}</p>
                                @endforeach
                            @else
                                Geen
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->roles()->pluck('name')->implode(', ') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->is_active == 1 ? 'Actief' : 'Inactief' }}
                        </td>
                        <td class="px-6 py-4 text-right justify-end flex">
                            <a href="{{ route('edituser', $user->id) }}" class="px-2 font-medium no-underline text-blue-600 dark:text-blue-500 hover:underline">Bewerken</a>
                            @if($user->deleted_at != NULL)
                                <a href="#" wire:click="restore({{ $user->id }})" class="px-2 font-medium no-underline text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-orange-700" viewBox="0 0 512 512">
                                        <path d="M125.7 160H176c17.7 0 32 14.3 32 32s-14.3 32-32 32H48c-17.7 0-32-14.3-32-32V64c0-17.7 14.3-32 32-32s32 14.3 32 32v51.2L97.6 97.6c87.5-87.5 229.3-87.5 316.8 0s87.5 229.3 0 316.8-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3-163.8-62.5-226.3 0L125.7 160z"/></svg>
                                </a>
                            @else
                                <a href="#" wire:click="delete({{ $user->id }})" wire:confirm="Ben je zeker dat je {{ $user->first_name }} {{ $user->last_name }} wilt verwijderen?"
                                   class="px-2 font-medium text-blue-600 dark:text-blue-500 hover:underline text-right object-right flex inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-red-700" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                    </svg>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Geen gebruikers gevonden
                        </th>
                        <td class="px-6 py-4"></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="bg-white p-2 px-4 border-b dark:bg-gray-800">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="flex flex-row">
                    <div
                        class="p-4 basis-5/6 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Kind toevoegen
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            Voeg een kind toe.
                        </p>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <div
                        class="basis-1/6 p-4 text-sm font-normal text-right rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 align-middle content-center">
                        <a href="{{ route('home') }}" wire:navigate type="button"
                           class="text-white text-decoration-none fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center me-2 mb-2 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                            Terug
                        </a>

                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow sm:px-8 sm:py-6 sm:w-full ">
                    <form method="POST" wire:submit.prevent="saveChild" class="max-w-xl mx-auto">
                        @csrf
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="first_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voornaam</label>
                                <input wire:model="first_name" type="text" id="first_name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error( 'first_name')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="last_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Familienaam</label>
                                <input wire:model="last_name" type="text" id="last_name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error( 'last_name')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="studiekeuzes"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Studiekeuze</label>
                                <select wire:model="studiekeuze_id" id="studiekeuzes"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    <option value="Selecteer een studiekeuze" selected >Selecteer een studiekeuze.
                                    </option>
                                    @foreach( $studiekeuzes as $studiekeuze)
                                        <option class="py-2 my-2"
                                                value="{{ $studiekeuze->id }}">{{ $studiekeuze->name }}</option>
                                    @endforeach
                                </select>
                                @error('studiekeuze_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
{{--                        <div class="relative z-0 w-full mb-3 group">--}}
{{--                            <label for="users"--}}
{{--                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ouder/Voogd</label>--}}
{{--                            <select wire:model="user_id" id="users"--}}
{{--                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">--}}
{{--                                <option value="Selecteer een ouder/voogd"  selected >Selecteer een ouder/voogd.--}}
{{--                                </option>--}}
{{--                                @foreach( $users as $user)--}}
{{--                                    <option class="py-2 my-2"--}}
{{--                                            value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('users')--}}
{{--                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

                        <button type="submit"
                                class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                            Versturen
                        </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

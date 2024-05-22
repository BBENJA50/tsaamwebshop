<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="flex flex-row">
                    <div class="p-4 basis-5/6 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Studiekeuze toevoegen
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            Voeg een studiekeuze toe.
                        </p>
                    </div>
                    <div class="basis-1/6 p-4 text-sm font-normal text-right rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 align-middle content-center">
                        <a href="{{ route('studiekeuzes') }}" wire:navigate type="button"
                           class="text-white text-decoration-none fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center me-2 mb-2 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                            Terug
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow sm:px-8 sm:py-6 sm:w-full">
                    <form method="POST" wire:submit.prevent="saveStudiekeuze" class="max-w-xl mx-auto">
                        @csrf
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="academicYear"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schooljaar</label>
                                <select wire:model="academic_year_id" id="academicYear"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    @foreach($academic_years as $academic_year)
                                        <option {{ $academic_year->id == "3" ? 'selected' : '' }} class="py-2 my-2"
                                                value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                    @endforeach
                                </select>
                                @error('academic_year_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="campusses"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Campus</label>
                                <select wire:click="updateName" wire:model="campus_id" id="campusses"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    <option value="Selecteer een campus" selected>Selecteer een campus.</option>
                                    @foreach($campusses as $campus)
                                        <option class="py-2 my-2"
                                                value="{{ $campus->id }}">{{ $campus->name }}</option>
                                    @endforeach
                                </select>
                                @error('campus_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="grades"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leerjaar</label>
                                <select wire:click="updateName" wire:model="grade_id" id="grades"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    <option value="Selecteer een leerjaar" selected>Selecteer een leerjaar.</option>
                                    @foreach($grades as $grade)
                                        <option class="py-2 my-2"
                                                value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="studyFields"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Richting</label>
                                <select wire:click="updateName" wire:model="study_field_id" id="studyFields"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    <option value="Selecteer een richting" selected>Selecteer een richting.</option>
                                    @foreach($study_fields as $study_field)
                                        <option class="py-2 my-2"
                                                value="{{ $study_field->id }}">{{ $study_field->name }}</option>
                                    @endforeach
                                </select>
                                @error('study_field_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="naam"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Naam</label>
                            <input wire:model="name" type="text" id="naam"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-row justify-between">
                            <button type="submit" wire:click="$set('createNew', false)"
                                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                                Versturen
                            </button>
                            <button type="submit" wire:click="$set('createNew', true)"
                                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                                Versturen en nieuw aanmaken
                            </button>
                        </div>
                        @if(session('message'))
                            <p class="text-green-500 text-xs mt-1">{{ session('message') }}</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


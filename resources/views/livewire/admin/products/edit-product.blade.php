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
                            <label for="naam"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Naam</label>
                            <input wire:model="name" value=" {{ $name }}" type="text" id="naam"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beschrijving</label>
                            <textarea wire:model="description" value=" {{ $description }}" id="description" rows="4"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prijs</label>
                            <input wire:model="price" value=" {{ $price }}" step="0.01" type="number" id="price"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">

                            <div class="relative z-0 w-full mb-3 group">
                                <label for="categories"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorie</label>
                                <select wire:model="category_id" id="categories"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    <option value="Selecteer een categorie" selected disabled>Selecteer een categorie.
                                    </option>
                                    @foreach( $categories as $category)
                                        <option
                                            {{ $category->id == $product->category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categories')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="z-0 w-full mb-3 group">
                                <div
                                    x-data="{
                                                open: false,
                                                toggle() {
                                                    if (this.open) {
                                                        return this.close()
                                                    }
                                                    this.$refs.button.focus()
                                                    this.open = true
                                                },
                                                close(focusAfter) {
                                                    if (! this.open) return
                                                    this.open = false
                                                    focusAfter && focusAfter.focus()
                                                }
                                            }"
                                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                    x-id="['dropdownHelperRadioButton']"
                                    class="relative"
                                >
                                    <label for="dropdownHelperRadioButton"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attributen</label>
                                    <button x-ref="button"
                                            x-on:click="toggle()"
                                            :aria-expanded="open"
                                            :aria-controls="$id('dropdownHelperRadioButton')"
                                            id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio"
                                            class="w-full text-white bg-orange-600 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm ps-3 py-2.5  text-end inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 relative"
                                            type="button">
                                        <svg class="w-2.5 h-2.5 me-2.5" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                        {{ $attributen[$selectedAttribute]->name }}
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div x-ref="panel"
                                         x-show="open"
                                         x-transition.origin.top.left
                                         x-on:click.outside="close($refs.button)"
                                         :id="$id('dropdownHelperRadioButton')" id="dropdownHelperRadio"
                                         class=" z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600"
                                         data-popper-reference-hidden="" data-popper-escaped=""
                                         data-popper-placement="top" style="display: none; margin: 0px; ">
                                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownHelperRadioButton">
                                            @foreach( $attributen as $attribute)
                                                <li>
                                                    <div x-on:click="open = false"
                                                         x-data="{changeSelectedAttribute: () => { @this.changeSelectedAttribute({{ $attribute->id }}) }}"
                                                         class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <div class="flex items-center h-5">
                                                            <input x-on:change="changeSelectedAttribute"
                                                                   wire:model="attribute_id"
                                                                   id="helper-radio-{{ $attribute->id }}"
                                                                   name="attribute-radio"
                                                                   type="radio"
                                                                   value=" {{ $attribute->id }}"
                                                                   class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        </div>
                                                        <div class="ms-2 text-sm">
                                                            <label for="helper-radio-{{ $attribute->id }}"
                                                                   class="font-medium text-gray-900 dark:text-gray-300">
                                                                <div>{{ $attribute->name }}</div>
                                                                <div class="flex flex-wrap">
                                                                    @foreach( $attribute->attributeOptions as $attributeOption)
                                                                        <p id="helper-radio-text-{{ $attributeOption->id }}"
                                                                           class="text-xs font-normal px-1 text-gray-500 dark:text-gray-300">
                                                                            {{ $attributeOption->value }}</p>
                                                                    @endforeach
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="subjects"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vak</label>
                            <select wire:model="subject_id" id="subjects"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                <option value="Selecteer een vak" selected>Selecteer een vak.
                                </option>
                                @foreach( $subjects as $subject)
                                    <option class="py-2 my-2"
                                            value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{--                        jaartal/school filteren voor studiekeuzes--}}
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="academic_year"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Academisch
                                    Jaar</label>
                                <select wire:model.live="selectedAcademicYear" id="academic_year"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    @foreach($academic_years as $year)
                                        <option @if($year->name == "2024-2025") selected
                                                @endif value="{{ $year->id }}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedAcademicYear')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="campus"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Campus</label>
                                <select wire:model.live="selectedCampus" id="campus"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                                    <option value="">Beide</option>
                                    @foreach($campusses as $campus)
                                        <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedCampus')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{--                        Studiekeuzes selecteren--}}
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecteer de
                            studierichtingen waar dit product toe behoort.<br> (Houd CTRL-toets om meerdere te
                            selecteren)</p>
                        <div class="relative z-0 w-full mb-3 group overflow-auto h-100">
                            <select
                                class="h-60 w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 rounded-md"
                                wire:model="selectedStudiekeuzes" multiple>
                                @foreach($studiekeuzes as $studiekeuze)
                                    @if($selectedAcademicYear == $studiekeuze->academic_year_id)
                                        @if($selectedCampus == $studiekeuze->campus_id)
                                            <option value="{{ $studiekeuze->id }}">{{ $studiekeuze->name }}
                                            </option>
                                        @elseif($selectedCampus == "")
                                            <option value="{{ $studiekeuze->id }}">{{ $studiekeuze->name }}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @error('subject_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                            <button type="submit"
                                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                                Versturen
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

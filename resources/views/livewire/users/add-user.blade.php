<div id="exampleWrapper" class="overflow-hidden grid grid-cols-8 gap-4 pt-2">
    <div class="col-start-2 col-span-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <div class="flex flex-row">
                    <div
                        class="p-4 basis-5/6 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Gebruiker toevoegen
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                            Voeg een gebruiker toe.
                        </p>
                    </div>
                    <div
                        class="basis-1/6 p-4 text-sm font-normal text-right rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 align-middle content-center">
                        <a href="{{ route('gebruikers') }}" wire:navigate type="button"
                           class="text-white text-decoration-none fill-white bg-orange-500 hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-4 py-2.5 text-center me-2 mb-2 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">
                            Terug
                        </a>

                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow sm:px-8 sm:py-6 sm:w-full ">
                    <form class="max-w-xl mx-auto">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="voornaam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voornaam</label>
                                <input type="text" id="voornaam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="familienaam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Familienaam</label>
                                <input type="text" id="familienaam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email adres</label>
                                <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="relative z-0 w-full mb-3 group">
                                <label for="gsmnummer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">GSM-nummer (0123-123-123)</label>
                                <input type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" name="gsmnummer" id="gsmnummer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " required />
                            </div>
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="floating_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paswoord</label>
                            <input type="password" name="floating_password" id="floating_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " required />
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bevestig paswoord</label>
                            <input type="password" name="confirm_password" id="floating_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " required />
                        </div>
                        <button type="submit" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-orange-700">Versturen</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

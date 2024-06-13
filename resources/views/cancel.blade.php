<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-3xl font-semibold text-center text-gray-800 dark:text-white mb-4">{{ __('Betaling Geannuleerd') }}</h2>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-6">{{ __('Je betaling is geannuleerd. Probeer het opnieuw of neem contact op met de klantenservice.') }}</p>

                <div class="flex justify-center my-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11.414l-1 1V7a1 1 0 00-2 0v4a1 1 0 001 1h2a1 1 0 000-2h-1V8.414l1-1a1 1 0 10-1.414-1.414l-1 1z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="text-center mb-4">
                    <a href="{{ route('checkout') }}" class=" no-underline bg-tsaam-500 hover:bg-tsaam-700 text-white font-bold py-2 px-4 rounded">{{ __('Terug naar afrekenen') }}</a>
                </div>

                <div class="text-center">
                    <p class="text-gray-600 dark:text-gray-400">{{ __('Als je vragen hebt, neem dan contact op met onze klantenservice.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

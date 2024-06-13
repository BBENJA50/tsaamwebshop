<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-3xl font-semibold text-center text-gray-800 dark:text-white mb-4">{{ __('Betaling Succesvol') }}</h2>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-6">{{ __('Bedankt voor je aankoop! Je bestelling is succesvol verwerkt.') }}</p>

                <div class="flex justify-center my-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="no-underline bg-tsaam-500 hover:bg-tsaam-700 text-white font-bold py-2 px-4 rounded">{{ __('Terug naar Home') }}</a>
                </div>

                <div class="text-center">
                    <p class="text-gray-600 dark:text-gray-400">{{ __('Je ontvangt binnenkort een bevestigingsmail.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div>
    <x-slot name="header">

        <div class="flex flex-row justify-between items-center content-center"><h2 class="font-semibold pt-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Welkom, ') . Auth::user()->first_name . ' ' . Auth::user()->last_name . ('.') }}
            </h2>
            <a class="bg-tsaam-500 px-2  no-underline rounded border-tsaam-700 border text-white m-0"
               href="{{ route('shoppingCart') }}">
                <div class="flex flex-row items-center">
                    <p class="bg-tsaam-600 rounded-full mt-2 px-2" > @if( session()->has('myCount') ) {{ session()->get('myCount') }} @else {{ 0 }} @endif</p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-10 h-6 fill-white">
                        <path
                            d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16z"/>
                    </svg>
                </div>
            </a>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-row justify-between items-center content-center">
                <div class="p-6 text-xl font-semibold text-gray-900 dark:text-gray-100">
                    {{ __("Mijn Bestellingen per kind") }}
                </div>
                <div>
                    <a href="{{ route('home') }}" wire:navigate type="button"
                       class="fill-white bg-tsaam-500 no-underline text-white hover:bg-tsaam-700 focus:outline-none focus:ring-4 focus:ring-tsaam-300 font-medium rounded-full text-sm px-4 py-2.5 text-center mx-4 dark:bg-tsaam-500 dark:hover:bg-tsaam-600 dark:focus:ring-tsaam-700">
                        Terug
                    </a>
                </div>
            </div>

            <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="min-w-full divide-y divide-gray-300 border-tsaam-700 border">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Bestelnummer
                        </th>
                        <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Ouder/Voogd
                        </th>
                        <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Naam Kind
                        </th>
                        <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Totaal Prijs
                        </th>
                        <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Besteldatum
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-300 dark:divide-gray-700">
                    @foreach($orders as $order)
                        <tr class="cursor-pointer hover:bg-gray-200" wire:click="toggleDetails({{ $order->id }})">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $order->order_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $order->parent_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $order->child_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                €{{ number_format($order->total_price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $order->ordered_at }}
                            </td>
                        </tr>
                        @if(isset($expandedOrder[$order->id]))
                            <tr>
                                <td colspan="5" class="bg-gray-50 dark:bg-gray-700 p-4">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Product
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Optie
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Hoeveelheid
                                            </th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Prijs
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($order->details as $detail)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $detail->product_name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $detail->product_option }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $detail->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    €{{ number_format($detail->price, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

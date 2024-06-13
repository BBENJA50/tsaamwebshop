<x-app-layout>
    <div class=" ">
        <div class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-2 mb-2 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-row justify-between items-center content-center py-0 my-0">

                    <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white">
                        {{ __('Checkout') }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="card mb-4 shadow sm:rounded-lg">
                <div
                    class="card-header bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4 sm:p-6 rounded-t  lg:rounded-t xl:rounded-t ">
                    <h4 class="mb-0">Order Overzicht</h4>
                </div>
                <div class="card-body p-4 sm:p-6 dark:bg-gray-800 rounded-b lg:rounded-b xl:rounded-b ">
                    @foreach($children as $child)
                        <div class="">
                            <h5 class="text-xl font-semibold mb-4" >{{ $child->first_name }} {{ $child->last_name }}</h5>
                            <table class="table table-bordered w-full text-center text-sm ">
                                <thead>
                                <tr>
                                    <th scope="col" class="w-2/5 text-left">Product</th>
                                    <th scope="col" class="w-1/5">Hoeveelheid</th>
                                    <th scope="col" class="w-1/5">Prijs</th>
                                    <th scope="col" class="w-1/5">Totaal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $item)
                                    @if($item['child_id'] == $child->id)
                                        <tr>
                                            <td class="text-left p-2 "> - {{ $item['name'] }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>€ {{ number_format($item['price'], 2) }}</td>
                                            <td>€ {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                    <hr>
                    <div class="mt-4 flex flex-row justify-between items-center">
                        <strong class="text-xl">Totaal te betalen: € {{ number_format($cartTotal, 2) }}</strong>
                        <form action="{{ route('processCheckout') }}" method="POST" class="">
                            @csrf
                            <button type="submit" class="bg-tsaam-500 hover:bg-tsaam-700 text-white font-bold py-2 px-4 rounded">Doorgaan naar betaling</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</x-app-layout>

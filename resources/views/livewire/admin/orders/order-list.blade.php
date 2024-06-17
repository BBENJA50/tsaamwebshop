<div class="max-w-7xl py-4 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h2 class="font-semibold text-xl">Orders</h2>
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-4">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Order Number
                    </th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Parent Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Child Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Total Price
                    </th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Ordered At
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($orders as $order)
                    <tr class="cursor-pointer" wire:click="toggleOrderDetails({{ $order->id }})">
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
                    @if ($expandedOrderId === $order->id)
                        <tr class="bg-gray-100 dark:bg-gray-900">
                            <td colspan="5" class="px-6 py-4">
                                <h4 class="font-semibold">Order Details</h4>
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-2">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-2">Product</th>
                                        <th class="px-4 py-2">Quantity</th>
                                        <th class="px-4 py-2">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($order->details as $detail)
                                        <tr>
                                            <td class="px-4 py-2">{{ $detail->product_name }}</td>
                                            <td class="px-4 py-2">{{ $detail->quantity }}</td>
                                            <td class="px-4 py-2">€{{ number_format($detail->price, 2) }}</td>
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
        </div>
    </div>
</div>

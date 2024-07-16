<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-2">
            <div class="bg-white shadow-md rounded my-6">
                @if($payments->count() > 0)
                <table class="text-left w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-800 text-white">
                            <th class="py-3 px-4 text-left font-medium text-white border-b border-gray-300 sm:rounded-tl">ID</th>
                            <th class="py-3 px-4 text-left font-medium text-white border-b border-gray-300 sm:rounded-tl">OwnerID</th>
                            <th class="py-3 px-4 text-left font-medium text-white border-b border-gray-300 sm:rounded-tl">Amount</th>
                            <th class="py-3 px-4  font-medium text-white border-b border-gray-300 sm:rounded-tl">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-300 sm:rounded-bl">{{ $payment->id }}</td>
                            <td class="py-4 px-6 border-b border-gray-300 sm:rounded-bl">{{ $payment->owner_id }}</td>
                            <td class="py-4 px-6 border-b border-gray-300 sm:rounded-bl">${{ $payment->amount }}</td>
                            <td class="py-4 px-6 border-b border-gray-300 sm:rounded-br">
                                @if($payment->status === 'success')
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-green-500 rounded-full">Succeeded</span>
                                @else
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">Incomplete</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @else
                <p class="p-4">No payments found.</p>
                @endif
                @can('payment access')
                <div class="text-right p-4 py-10 sm:rounded-b">
                    {{ $payments->links() }}
                </div>
                @endcan
            </div>
        </div>
    </main>
    </div>
</x-app-layout>
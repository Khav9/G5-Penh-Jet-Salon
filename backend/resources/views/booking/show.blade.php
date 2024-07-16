<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            @can('Booking show')
            <div class="container mx-auto px-6 py-4">
                <div class="bg-gray-100 border border-gray-300 rounded-lg shadow p-6 flex flex-wrap justify-between items-center">
                    <!-- User Info -->
                    <div class="w-full sm:w-auto mb-4 sm:mb-0">
                        <p class="mb-2 text-xl font-bold">Customer name: {{$userBooking[0]->name}}</p>
                        <p class="text-base text-gray-800">Gender: {{$userBooking[0]->gender}}</p>
                    </div>

<!-- Total Price -->
<div class="w-full sm:w-auto mb-4 sm:mb-0">
    <?php
    $totalPrice = 0;
    $totalDiscount = 0;
    foreach ($services as $service) {
        $totalPrice += $service->price;
        $totalDiscount += $service->discount;
    }
    ?>
    <div class="bg-gray-200 border border-gray-300 rounded-lg shadow p-6 mx-auto" style="max-width: 300px;">
        <div class="text-center">
            <p class="text-1.5xl font-bold text-gray-800">Total Service Price: {{$totalPrice}} $</p>
            <p class="text-1.5xl font-bold text-gray-800">Discounts price: {{$totalDiscount}} $</p>
        </div>
    </div>
</div>

                    <!-- Contact Info -->
                    <div class="w-full sm:w-auto border-t sm:border-t-0 sm:border-l-2 border-gray-400 sm:pl-6 sm:ml-6 pt-4 sm:pt-0">
                        <p class="mb-2 text-base text-gray-800">Gmail: {{$userBooking[0]->email}}</p>
                        <p class="text-base text-gray-800">Phone: {{$userBooking[0]->phone}}</p>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($services as $service)
                <div class="flex justify-center">
                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 w-full md:flex-row">
                        <img class="object-cover w-full h-36 md:h-auto md:w-36 rounded-t-lg md:rounded-l-lg" src="{{$service->image}}" alt="Service Image">
                        <div class="flex flex-col justify-between p-4 leading-normal w-full">
                            <h5 class="mb-2 text-base font-bold text-gray-900 dark:text-white">Name: {{$service->service_name}}</h5>
                            <p class="mb-1 text-sm text-gray-700 dark:text-gray-400">Price: {{$service->price}} $</p>
                            <p class="mb-1 text-sm text-gray-700 dark:text-gray-400">Discount: {{$service->discount}} $</p>
                            <p class="mb-1 text-sm text-gray-700 dark:text-gray-400">Duration: {{$service->duration}} h</p>
                            <p class="mb-1 text-sm text-gray-700 dark:text-gray-400">Description: {{$service->description}}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endcan
        </main>
    </div>
</x-app-layout>

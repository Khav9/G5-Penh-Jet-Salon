<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 py-8 lg:py-12">
        <div class="container mx-auto px-6 lg:px-12">
            <a href="#" class="relative flex flex-col lg:flex-row items-center bg-white border border-gray-200 rounded-2xl shadow-2xl hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 transition-all w-full lg:max-w-6xl mx-auto">
                <img id="service-image" class="object-cover w-full lg:w-1/2 h-64 lg:h-auto rounded-t-2xl lg:rounded-t-none lg:rounded-l-2xl" src="{{$service->image}}" alt="Service Image">
                <div id="service-details" class="flex flex-col flex-grow p-6 lg:p-8">
                    <h5 id="service-name" class="mb-4 text-2xl lg:text-3xl font-bold ">Service Name: <b class="text-blue-400">{{$service->service_name}}</b></h5>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Price:</b> ${{$service->price}}</p>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Duration:</b> {{$service->duration}} h</p>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Discount:</b> ${{$service->discount}}</p>
                    <p class="mb-4 text-base lg:text-lg text-gray-700 dark:text-gray-300"><b>Description:</b> {{$service->description}}</p>
                </div>
            </a>
        </div>
    </main>
</x-app-layout>

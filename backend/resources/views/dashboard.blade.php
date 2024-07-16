<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">


                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

                <p>Role : <b>
                        @foreach(auth()->user()->roles as $role)
                        {{ $role->name }}
                        @endforeach
                    </b> </p>
                <!-- <p>{{auth()->user()->roles[0]->name}}</p> -->

            </div>
            {{-- In your Blade view --}}


        </main>
        <div class="m-1 grid grid-cols-1 gap-4 container-fluid pt-4 px-4 md:grid-cols-2 lg:grid-cols-4">
            @if (auth()->user()->roles[0]->name === 'admin')
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-blue-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg class="w-12 h-12 text-blue-500 dark:text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                    <path d="M42-160v-72q0-33 17-62t47-44q51-26 115-44t141-18q77 0 141 18t115 44q30 15 47 44t17 62v72q0 17-11.5 28.5T642-120H82q-17 0-28.5-11.5T42-160Zm320-280q-66 0-113-47t-47-113h-10q-9 0-14.5-5.5T172-620q0-9 5.5-14.5T192-640h10q0-45 22-81t58-57v38q0 9 5.5 14.5T302-720q9 0 14.5-5.5T322-740v-54q9-3 19-4.5t21-1.5q11 0 21 1.5t19 4.5v54q0 9 5.5 14.5T422-720q9 0 14.5-5.5T442-740v-38q36 21 58 57t22 81h10q9 0 14.5 5.5T552-620q0 9-5.5 14.5T532-600h-10q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T442-600H282q0 33 23.5 56.5T362-520Zm297 144-3-14q-6-2-11.5-4.5T634-402l-12 4q-7 2-13.5 0t-10.5-9l-4-7q-4-6-2.5-13t6.5-12l10-9v-24l-10-9q-5-5-6.5-12t2.5-13l4-7q4-7 10.5-9t13.5 0l12 4q4-4 10-7t12-5l3-14q2-7 7-11.5t12-4.5h8q7 0 12 4.5t7 11.5l3 14q6 2 12 5t10 7l12-4q7-2 13.5 0t10.5 9l4 7q4 6 2.5 13t-6.5 12l-10 9v24l10 9q5 5 6.5 12t-2.5 13l-4 7q-4 7-10.5 9t-13.5 0l-12-4q-5 5-10.5 7.5T708-390l-3 14q-2 7-7 11.5t-12 4.5h-8q-7 0-12-4.5t-7-11.5Zm23-54q12 0 21-9t9-21q0-12-9-21t-21-9q-12 0-21 9t-9 21q0 12 9 21t21 9Zm68-152-4-20q-9-3-16.5-7.5T716-620l-21 7q-9 3-18-.5T663-625l-6-10q-5-8-3.5-17.5T663-669l17-15q-2-5-2-8v-16q0-3 2-8l-17-15q-8-7-9.5-16.5T657-765l6-10q5-8 14-11.5t18-.5l21 7q6-6 13.5-10.5T746-798l4-20q2-10 9.5-16t17.5-6h10q10 0 17.5 6t9.5 16l4 20q9 3 16.5 7.5T848-780l21-7q9-3 18 .5t14 11.5l6 10q5 8 3.5 17.5T901-731l-17 15q2 5 2 8v16q0 3-2 8l17 15q8 7 9.5 16.5T907-635l-6 10q-5 8-14 11.5t-18 .5l-21-7q-6 6-13.5 10.5T818-602l-4 20q-2 10-9.5 16t-17.5 6h-10q-10 0-17.5-6t-9.5-16Zm32-68q21 0 35.5-14.5T832-700q0-21-14.5-35.5T782-750q-21 0-35.5 14.5T732-700q0 21 14.5 35.5T782-650Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Owner</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">{{$countOwner}}</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-purple-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg  class="w-12 h-12 text-purple-500 dark:text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                    <path d="M40-272q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240v-32Zm698 112q11-18 16.5-38.5T760-240v-40q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v40q0 33-23.5 56.5T840-160H738ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Customer</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">{{$countCustomer}}</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-purple-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg  class="w-12 h-12 text-purple-500 dark:text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                    <path d="M40-272q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240v-32Zm698 112q11-18 16.5-38.5T760-240v-40q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v40q0 33-23.5 56.5T840-160H738ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Earning</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">$XXX</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-purple-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg  class="w-12 h-12 text-purple-500 dark:text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                    <path d="M40-272q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240v-32Zm698 112q11-18 16.5-38.5T760-240v-40q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v40q0 33-23.5 56.5T840-160H738ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Provinces</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">{{$countProvince}}</p>
                </div>
            </div>
            @endif
            @if (auth()->user()->roles[0]->name === 'owner')
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-purple-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-12 h-12 text-purple-500 dark:text-gray-400 mb-3">
                    <path d="M342-80q-28 0-49-17t-28-44l-45-179h520l-45 179q-7 27-28 44t-49 17H342Zm138-560q0-90 61-156t152-80q5-1 9 1t8 5q4 3 5.5 7.5t.5 9.5q-11 79-64.5 137.5T520-644v84h280q17 0 28.5 11.5T840-520v80q0 33-23.5 56.5T760-360H200q-33 0-56.5-23.5T120-440v-80q0-17 11.5-28.5T160-560h280v-84q-78-13-131.5-71.5T244-853q-1-5 .5-9.5t5.5-7.5q4-3 8-5t9-1q91 14 152 80t61 156Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-purple-900 dark:text-white">Service</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">{{$countService}}</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-green-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg class="w-12 h-12 text-green-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                    <path d="M725-305q-56-58-87.5-126.5T606-591q0-91 31.5-159.5T725-877l50 50q-48 51-73.5 104.5T676-591q0 78 25.5 131.5T775-355l-50 50Zm139-142q-26-28-42-65.5T806-591q0-41 16-78.5t42-65.5l50 50q-18 20-28 42.5T876-591q0 29 10 51.5t28 42.5l-50 50Zm-504 6q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM40-120v-94q0-38 19-64.5t49-41.5q51-26 120.5-43T360-380q62 0 131 17t120 43q30 15 49.5 41.5T680-214v94H40Zm60-60h520v-34q0-16-8.5-29.5T587-266q-48-27-109-40.5T360-320q-57 0-118.5 14.5T132-266q-14 7-23 21.5t-9 30.5v34Zm260-321q39 0 64.5-25.5T450-591q0-39-25.5-64.5T360-681q-39 0-64.5 25.5T270-591q0 39 25.5 64.5T360-501Zm0-90Zm0 411Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-green-700 dark:text-white">Booking</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">0</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-pink-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-12 h-12 text-pink-500 dark:text-gray-400 mb-3">
                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760H520q-71 0-115.5 44.5T360-600v240q0 71 44.5 115.5T520-200h320q0 33-23.5 56.5T760-120H200Zm320-160q-33 0-56.5-23.5T440-360v-240q0-33 23.5-56.5T520-680h280q33 0 56.5 23.5T880-600v240q0 33-23.5 56.5T800-280H520Zm120-140q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-pink-700 dark:text-white">Earning</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">$760</p>
                </div>
            </div>
            <div class="flex max-w-sm p-3 bg-white border-l-4 border-red-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-12 h-12 text-red-500 dark:text-gray-400 mb-3">
                    <path d="M120-160q-33 0-56.5-23.5T40-240v-400q0-17 11.5-28.5T80-680q17 0 28.5 11.5T120-640v400h640q17 0 28.5 11.5T800-200q0 17-11.5 28.5T760-160H120Zm160-160q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80q0-33-23.5-56.5T280-480v80h80Zm400 0h80v-80q-33 0-56.5 23.5T760-400Zm-200-40q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM280-640q33 0 56.5-23.5T360-720h-80v80Zm560 0v-80h-80q0 33 23.5 56.5T840-640Z" />
                </svg>
                <div class="ml-3">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-red-900 dark:text-white">Admin %</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 font-bold">8%</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
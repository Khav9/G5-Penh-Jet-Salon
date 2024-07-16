<x-guest-layout>
    <div class="font-sans min-h-screen antialiased bg-gray-900 pt-6 pb-5">
        <div class="flex flex-col justify-center max-w-4xl sm:m-auto mx-5 mb-5 space-y-5">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
          <h1 class="font-bold text-center text-4xl text-yellow-500">Penh Jet<span class="text-blue-500"> Salon</span></h1>
            <div class="flex flex-col justify-center font-[sans-serif] p-4 ">
                <div class="max-w-md w-full mx-auto shadow-[0_2px_10px_-2px_rgba(195,169,50,0.5)] relative">

                    <form class="bg-white p-8 rounded-lg shadow" method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-xl font-bold text-orange-500 mb-8 text-center">Create free account</h3>
                        <div class="space-y-3">
                            <input name="name" id="name" type="text" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Username" />
                            <input name="email" type="text" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter email" />
                            <input name="password" type="password" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter password" />
                            <input name="password_confirmation" id="password_confirmation" type="password" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <label for="" class="text-gray-500 text-sm">Birhtday</label>
                            <input name="birth" type="date" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <input name="shop_name" id="shop_name" type="text" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Shop Name" />
                            <label for="shop_profile" class="text-gray-500 text-sm">Upload Profile Shop:</label>
                            <input name="shop_profile" type="file" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <select id="province_id" name="province_id" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all">
                                <option selected disabled>Select Province</option>
                                @foreach($provinces as $key => $province)
                                <option value="{{$province->id}}">{{$province->province_name}}</option>
                                @endforeach
                            </select>
                            <label for="qr_code" class="text-gray-500 text-sm">Upload QR Code:</label>
                            <input name="qr_code" type="file" class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Enter confirm password" />
                            <div class="flex items-center mb-3">
                                <input name="gender" type="radio" value="male" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Male<a href="javascript:void(0);" class="text-orange-500 font-semibold hover:underline ml-1"></a>
                                </label>
                                <input name="gender" value="female" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Female<a href="javascript:void(0);" class="text-orange-500 font-semibold hover:underline ml-1"></a>
                                </label>
                                <input name="gender" type="radio" value="other" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Other<a href="javascript:void(0);" class="text-orange-500 font-semibold hover:underline ml-1"></a>
                                </label>
                            </div>
                        </div>
                        <div id="address-map-container" class="mt-3" style="width:100%; height:400px">
                            <div class="">
                                <input id="search_input" name="city" type="text" class="mb-3 bg-gray-100 w-full text-sm text-gray-800 px-4 py-2 focus:bg-transparent outline-orange-300 transition-all" placeholder="Search your location" />
                                <svg xmlns="http://www.w3.org/2000/svg" id="current_location_btn" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0000F5">
                                    <path d="M440-42v-80q-125-14-214.5-103.5T122-440H42v-80h80q14-125 103.5-214.5T440-838v-80h80v80q125 14 214.5 103.5T838-520h80v80h-80q-14 125-103.5 214.5T520-122v80h-80Zm40-158q116 0 198-82t82-198q0-116-82-198t-198-82q-116 0-198 82t-82 198q0 116 82 198t198 82Zm0-120q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Z" />
                                </svg></div>
                                <input id="latitude" name="lat" type="hidden">
                                <input id="longitude" name="lng" type="hidden">
                                <div style="width:100%; height:100%" id="address-map"></div>
                            </div>
                            <div class="mt-8">
                                <button type="submit" class="mt-8 w-full py-4 px-8 text-sm tracking-wide font-semibold text-white bg-blue-500 hover:bg-orange-600 focus:outline-none">
                                    Create an account
                                </button>
                            </div>
                            <p class="text-sm mt-8 text-center text-gray-800">Already have an account? <a href="/" class="text-orange-500 font-semibold hover:underline ml-1">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Maps Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtSAkdlKPhpaKbVV4B_m7QO2b8CrBEGJ8&libraries=places"></script>
    
</x-guest-layout>
<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-1 pb-16">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <div class="p-6 space-y-6">
            <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="service_name" class="text-sm font-medium text-gray-900 block mb-2">Service Name</label>
                  <input type="text" name="service_name" id="service_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Enter Service Name" required="">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Price</label>
                  <input type="number" name="price" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Price" required="">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="discount" class="text-sm font-medium text-gray-900 block mb-2">Discount</label>
                  <input type="number" name="discount" id="discount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Discount">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="duration" class="text-sm font-medium text-gray-900 block mb-2">Duration</label>
                  <input type="number" name="duration" id="duration" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Duration" required="">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="default" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Default select</label>
                  <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Select Category</option>
                    @can('Service create')
                    @foreach($categories as $key => $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    @endcan
                  </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="image" class="text-sm font-medium text-gray-900 block mb-2">Image</label>
                  <input type="file" name="image" id="image" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Image Service" required="">
                </div>
                <div class="col-span-full">
                  <label for="description" class="text-sm font-medium text-gray-900 block mb-2">Service Details</label>
                  <textarea id="description" name="description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4" placeholder="Details"></textarea>
                </div>
              </div>
              <div class="col-span-12 sm:col-span-3">
                <button type="submit" class="mt-3 w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
  </div>
</x-app-layout>
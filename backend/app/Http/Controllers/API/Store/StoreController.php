<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopAddressResource;
use App\Http\Resources\StoreByProvinceResource;
use App\Http\Resources\StoreResource;
use App\Models\Address;
use App\Models\Province;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();
        $stores = StoreResource::collection($stores);
        return response()->json([
            'success' => true,
            'message' => 'All stores',
            'data' => $stores,
        ]);
    }
    
    public function StoreByProvince()
    {
        $stores = StoreResource::collection(Store::all());
        $storesArray = $stores->toArray(request());
        // Initialize the array to group stores by province
        $groupedByProvince = [];

        // Iterate through each store and group them by province name
        foreach ($storesArray as $store) {
            if (isset($store['address']['province'])){
                $provinceName = $store['address']['province']['province_name'];
                if (!isset($groupedByProvince[$provinceName])) {
                    $groupedByProvince[$provinceName] = [];
                }
                $groupedByProvince[$provinceName][] = $store;
            }
        }

        // Return the response as a JSON object
        return response()->json([
            'success' => true,
            'message' => 'Store by province name',
            'data' => $groupedByProvince,
        ]);
    }

    public function GetStoreByProvinceId(string $id)
{
    // Query stores with Eloquent and eager load address relationship
    $stores = Store::whereHas('address', function ($query) use ($id) {
            $query->where('province_id', $id);
        })
        ->with('address')
        ->get();
    // Format the response using your resource
    $storeByProvinceId = StoreResource::collection($stores);

    return response()->json([
        'success' => true,
        'message' => 'Stores fetched successfully by province id',
        'total' => $storeByProvinceId->count(), // Count of returned items
        'data' => $storeByProvinceId, // Actual data in resource format
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'shop_name' => 'required|string|max:255',
    //         'shop_profile' => 'shop_profile|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
    //         'province_id' => 'required|integer',
    //         'city' => 'required|string',
    //     ]);

    //     $user = Auth::user();
    //     $store = Store::find($user->store_id);
    //     $address = Address::find($store->address_id);

    //     if ($store->hasFile('shop_profile')) {
    //         if ($store->shop_profile) {
    //             Storage::delete($store->shop_profile);
    //         }
    //         $path = $store->file('shop_profile')->store('public/StoreImages');
    //         $storeProfile = Storage::url($path);
    //     } else {
    //         $storeProfile = $store->shop_profile;
    //     }

    //     $store->shop_name = $validator->shop_name;
    //     $address->city = $validator->city;
    //     $address->province_id = $validator->province_id;
    //     $store->save();
        
    // }
    public function update(Request $request)
{
    $validator = Validator::make($request->all(), [
        'shop_name' => 'required|string|max:255',
        'shop_profile' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'province_id' => 'required|integer',
        'city' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = Auth::user();

    $store = Store::find($user->store_id);
    $address = Address::find($store->address_id);

    if ($request->hasFile('shop_profile')) {
        if ($store->shop_profile) {
            Storage::delete($store->shop_profile);
        }
        $path = $request->file('shop_profile')->store('public/StoreImages');
        $storeProfile = Storage::url($path);
    } else {
        $storeProfile = $store->shop_profile;
    }

    $store->shop_name = $request->input('shop_name');
    $store->shop_profile = $storeProfile;
    $address->city = $request->input('city');
    $address->province_id = $request->input('province_id');

    $store->save();
    $address->save();

    return response()->json(['message' => 'Store updated successfully', 'store' => $store], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

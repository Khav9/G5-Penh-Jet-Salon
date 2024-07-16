<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\QRcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::All();
        return response()->json([
            'data' => $user
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
    //     $user = Auth::user();
    
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    //         'gender' => 'required|in:male,female,other',
    //         'phone' => 'nullable|regex:/^0[0-9]{2}\s[0-9]{3}\s[0-9]{3}$/',
    //         'birth' => 'nullable|date',
    //         'location' => 'nullable|string|max:255',
    //     ]);
    
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->gender = $request->gender;
    //     $user->phone = $request->phone;
    //     if ($request->birth){
    //         $user->birth = $request->birth;
    //     }
    //     $user->location = $request->location;
    //     $user->save();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'User updated successfully',
    //         'data' => $user
    //     ]);
    // }
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'phone' => 'nullable|regex:/^0[0-9]{2}\s[0-9]{3}\s[0-9]{3}$/',
            'location' => 'nullable|string|max:255',
            'birth' => 'nullable|date',
            'qr_code' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        $user->phone = $request->phone;
        if ($request->birth){
            $user->birth = $request->birth;
        }
        $user->location = $request->location;
        if ($request->hasFile('profile')) {
            if ($user->profile) {
                Storage::delete($user->profile);
            }
            $path = $request->file('profile')->store('public/UserProfile');
            $profileImage = Storage::url($path);
        } else {
            $profileImage = $user->profile;
        }
        $user->profile = $profileImage;
        $user->save();
        // Create qr 
        if ($request->hasFile('qr_code')) {
            $path = $request->file('qr_code')->store('public/QRcode');
            $qrcode = Storage::url($path);
        }else{
            $qrcode = null;
        }
        $qrcode = QRcode::create([
            'store_id' => $user->store_id,
            'qr_code' => $qrcode,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
            'qr_code' => $qrcode
        ]);
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

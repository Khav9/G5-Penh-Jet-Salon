<?php

namespace App\Http\Controllers\API\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ReplayResource;


class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $replies = Reply::where('comment_id', $id)->get();
        return response()->json([
            "success" => true,
            "data" => ReplayResource::collection($replies)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();

        if ($roles[0] !== 'owner') {
            return response()->json([
                "success" => true,
                "message" => "need user to be owner",
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:1024',
            'images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('public/ReplyImages');
            $imagePaths = Storage::url($path);
        } else {
            $imagePaths = null;
        }

        $reply = Reply::create([
            'text' => $request->text,
            'comment_id' => $id,
            'owner_id' => $user->id,
            'images' => $imagePaths
        ]);

        return response()->json([
            "success" => true,
            "message" => "Reply created successfully",
            "data" => $reply
        ], 201);
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
    public function update(Request $request, string $id)
    {
        $relply = Reply::find($id);
        if (!$relply) {
            return response()->json([
                "success" => false,
                "message" => "Reply not found",
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:1024',
            'images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if ($request->hasFile('images')) {
            if ($relply->images) {
                Storage::delete($relply->images);
            }
            $path = $request->file('images')->store('public/ReplyImages');
            $pathImage = Storage::url($path);
        } else {
            $pathImage = $relply->images;
        }

        if ($request->filled('text')) {
            $relply->text = $request->text;
        }

        $relply->images = $pathImage;
        $relply->save();

        return response()->json([
            "success" => true,
            "message" => "Reply updated successfully",
            "data" => $relply
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reply = Reply::find($id);
        if (!$reply) {
            return response()->json([
                "success" => false,
                "message" => "Reply not found",
            ], 404);
        }
        $reply->delete();
        return response()->json([
            "success" => true,
            "message" => "Reply deleted successfully",
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\API\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\commentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $comments = Comment::where('service_id', $id)->get();
        return response()->json([
            "success" => true,
            "data" => CommentResource::collection($comments),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:1024',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/CommentImages');
            $imagePaths = Storage::url($path);
        } else {
            $imagePaths = null;
        }

        $comment = Comment::create([
            'text' => $request->text,
            'service_id' => $id,
            'user_id' => $user->id,
            'image' => $imagePaths
        ]);

        return response()->json([
            "success" => true,
            "message" => "Comment created successfully",
            "data" => $comment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    public function update(Request $request, string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                "success" => false,
                "message" => "Comment not found",
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:1024',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if ($request->hasFile('image')) {
            if ($comment->image) {
                Storage::delete($comment->image);
            }
            $path = $request->file('image')->store('public/commentImages');
            $commentImage = Storage::url($path);
        } else {
            $commentImage = $comment->image;
        }

        if ($request->filled('text')) {
            $comment->text = $request->text;
        }

        // Save the updated comment
        $comment->image = $commentImage;
        $comment->save();

        return response()->json([
            "success" => true,
            "message" => "Comment updated successfully",
            "data" => $comment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                "success" => false,
                "message" => "Comment not found",
            ], 404);
        }
        $comment->delete();
        return response()->json([
            "success" => true,
            "message" => "Comment deleted successfully",
        ], 200);
    }
}

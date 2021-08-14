<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{

    public function store(StoreCommentRequest $request)
    {
        $request->validated();
        Comment::create($request->all());
    } //end of store


    public function edit(Request $request, Comment $comment)
    {
        if ($request->client_id != auth()->guard('clients')->user()->id) {
            return response()->json(["unauthrized"], 401);
        }
        return $comment;
    } //end of edit


    public function update(StoreCommentRequest $request, Comment $comment)
    {
        if ($request->client_id != auth()->guard('clients')->user()->id) {
            return response()->json(["unAuthrized"], 401);
        }

        $request->validated();
        $comment->update($request->all());
    } //end of update


    public function destroy(Request $request, Comment $comment)
    {
        if ($request->client_id != auth()->guard('clients')->user()->id) {
            return response()->json(["unauthrized"], 401);
        }
        $comment->delete();
    } //end of destroy
}

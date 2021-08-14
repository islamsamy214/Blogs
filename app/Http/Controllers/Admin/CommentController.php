<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentRequest;

class CommentController extends Controller
{
    private $comments_paginate = 10;

    public function index(Request $request)
    {
        if ($request->search) {
            $comments = $this->getSearch($request);
        } else {
            $comments = $this->getComments();
        }

        return $comments;
    } //end of index


    public function getComments()
    {
        $comments = Comment::with("client")->with("user")
            ->latest()->paginate($this->comments_paginate);

        return $comments;
    } //end of getComments


    public function getSearch($request)
    {
        $comments = Comment::where("body", "like", "%" . $request->search . "%")
            ->orWhereHas("user", function ($elq) use ($request) {
                $elq->where("name", "like", "%" . $request->search . "%");
            })
            ->orWhereHas("client", function ($elq) use ($request) {
                $elq->where("name", "like", "%" . $request->search . "%");
            })
            ->with("client")->with("user")
            ->latest()
            ->paginate($this->comments_paginate);

        return $comments;
    } //end of getSearch


    public function store(StoreCommentRequest $request)
    {
        $request->validated();
        Comment::create($request->all());
    } //end of store


    public function edit(Comment $comment)
    {
        return $comment;
    } //end of edit


    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $request->validated();
        $comment->update($request->all());
    } //end of update


    public function destroy(Comment $comment)
    {
        $comment->delete();
    } //end of destroy
}

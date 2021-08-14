<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $paginate_posts = 10;

    public function index(Request $request)
    {
        if ($request->category && $request->search) {
            $posts = $this->getCategoryAndSearch($request);
        } elseif ($request->category) {
            $posts = $this->getCategorySearch($request);
        } elseif ($request->search) {
            $posts = $this->getSearch($request);
        } else {
            $posts = $this->getPosts();
        }
        $categories = Category::latest()->get();

        return response()->json([$posts, $categories]);
    } //end of index

    public function getPosts()
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->latest()->paginate($this->paginate_posts);
        return $posts;
    } //end of getPosts

    public function getCategoryAndSearch($request)
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->where('category_id', $request->category)
            ->where('title', 'like', '%' . $request->search . '%')
            ->orWhere('body', 'like', '%' . $request->search . '%')
            ->latest()->paginate($this->paginate_posts);

        return $posts;
    } //end of getCatAndSearch

    public function getCategorySearch($request)
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->where('category_id', $request->category)
            ->latest()->paginate($this->paginate_posts);

        return $posts;
    } //end of getCategorySearch

    public function getSearch($request)
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->where('title', 'like', '%' . $request->search . '%')
            ->orWhere('body', 'like', '%' . $request->search . '%')
            ->latest()->paginate($this->paginate_posts);

        return $posts;
    } // end of getSearch

    public function show(Post $post)
    {
        return response()->json([
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'image' => $post->image,
            'image_path' => $post->image_path,
            'user' => $post->user,
            'created_at' => $post->created_at,
            'comments' => $this->commentFormatted($post->comments),
        ]);
    } //end of show

    public function commentFormatted($comments)
    {
        $formattedComments = [];
        foreach ($comments as $comment) {
            array_push($formattedComments, [
                'id' => $comment->id,
                'body' => $comment->body,
                'user' => $comment->user,
                'client' => $comment->client,
                'created_at' => $comment->created_at
            ]);
        }
        return $formattedComments;
    } //end of formating comments
}

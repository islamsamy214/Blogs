<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StorePostRequest;
use App\Traits\ImageTrait;

class PostController extends Controller
{
    use ImageTrait;

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


    public function create()
    {
        $categories = Category::latest()->get();
        return $categories;
    } //end of create


    public function store(StorePostRequest $request)
    {
        $request->validated();
        $form_data = $request->except("image");

        if ($request->image) {
            $form_data['image'] = $this->uploadImage($request->image, 'images/posts');
        }

        Post::create($form_data);
    } //end of store


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


    public function edit(Post $post)
    {
        $categories = Category::latest()->get();
        return response()->json([$post, $categories]);
    } //end of edit


    public function update(StorePostRequest $request, Post $post)
    {
        $request->validated();
        $form_data = $request->except("image");

        if ($request->image) {
            if ($post->image) {
                $this->deleteImage($post->image, 'posts/');
            } //end of deleting old image
            $form_data['image'] = $this->uploadImage($request->image, 'images/posts');
        }

        $post->update($form_data);
    } //end of update


    public function destroy(Post $post)
    {
        if ($post->image) {
            $this->deleteImage($post->image, 'posts/');
        } //end of deleting old image

        $post->delete();
    } //end of destroy
}

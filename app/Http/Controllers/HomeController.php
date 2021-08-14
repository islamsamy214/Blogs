<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $carousel_path = asset('images/home');
        $users = DB::select('SELECT users.name, users.email, users.image, COUNT(*) AS `posts_count` 
                                FROM `users` INNER JOIN `posts` ON users.id = posts.user_id 
                                WHERE users.id != 1
                                GROUP BY users.id ORDER BY `posts_count` DESC LIMIT 3');

        foreach ($users as $index => $user) {
            $users[$index]->image_path = asset('images/users/' . $user->image);
        } //end of adding image path assets to each user

        $posts = Post::where('image', '!=', null)
            ->latest()->limit(3)->get();

        return response()->json(['carouselPath' => $carousel_path, 'users' => $users, 'posts' => $posts]);
    } //end of index
}

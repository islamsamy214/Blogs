<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Client;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $clients_count = Client::count();
        $comments_count = Comment::count();
        $post_count = Post::count();
        $clients_data = DB::select('SELECT YEAR(created_at) as year,MONTH(created_at) as month, COUNT(*) AS count FROM `clients` GROUP BY month');

        return response()->json([$clients_count, $comments_count, $post_count, $clients_data]);
    } //end of index
}

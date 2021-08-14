<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $about_image_path = asset('images/about/about.jpg');
        return $about_image_path;
    } //end of index
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $title = '';
        //jika ada category, cari apa, adakah dalam database? dengan slug yang sama
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            //jika ada, maka title akan ditimpa
            $title = ' in ' . $category->name;
        }

        if(request('author')) {
            $author = User::firstWhere('username', request('author'));
            //jika ada, maka title akan ditimpa
            $title = ' by ' . $author->name;
        }

        return view('posts', [
            "title" => "All Posts" . $title,

            //bawa apapun yang ada di queri sebelumnya agar pagination berjalan di berbagai laman
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(4)->withQueryString() 

        ]);
    }
    // Routes mengirimkan model ke parameter kiri lalu diikat dengan variabel $post di kanan (Route Model Binding)
    // Digunakan untuk melewatkan proses query sehingga tidak perlu lagi mencari sesuai id
    // Sehingga orang tidak bisa menebak URL dengan tebak id
    // Variabel yang menerima $post harus sama dengan yang di routes
    public function show(Post $post){
        return view('post', [
            "title" => "Single Post",
            "post" => $post
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     * Method GET (Default)
     */
    public function index()
    {
        // ambilkan data post, yang user_id nya sama dengan user yang sedang login
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Method Post
     */
    //request menangani semua data yang dikirim dari form
    public function store(Request $request)
    {
        //memasukkan file dan mengembalikan path
        // return $request->file('image')->store('post-images');
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:5120',
            'body' => 'required'
        ]);

        if ($request->file('image')) {
            //kalau image ada isinya upload ke direktori berikut lalu isi ke database
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');

        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->author->id != auth()->user()->id) {
            abort(403);
        }
        return view('dashboard/posts/show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('/dashboard/posts/edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * Method PUT
     */

    //request data baru, post data lama
    public function update(Request $request, Post $post)
    {
        $rules =
            [
                'title' => 'required|max:255',
                'category_id' => 'required',
                'image' => 'image|file|max:5120',
                'body' => 'required'
            ];

            
            if ($request->slug != $post->slug) {
                $rules['slug'] = 'required|unique:posts';
            }
            
            $validatedData = $request->validate($rules);
            
            //jika dilakukan sebelum validasi maka gambar tersimpan di temp dan tak bisa dipanggil
            if ($request->file('image')) {
                //Kalau gambar lamanya gada, upload gambar baru. Kalau ada, hapus gambar sekarang
                if($request->oldImage) {
                    Storage::delete($request->oldImage);
                }

                //kalau image ada isinya upload ke direktori berikut lalu isi ke database
                $validatedData['image'] = $request->file('image')->store('post-images');
            }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');

        Post::where('id', $post->id)
            ->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     * Method DELETE
     */
    public function destroy(Post $post)
    {
        //delete file gambar
        if($post->image) {
            Storage::delete($post->image);
        }
        //lalu delete di tabel
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!!');
    }

    public function checkSlug(Request $request)
    {
        //create slug, ambil dari model post, ambil field slug, titlenya diambil dari request dengan id title karena ada di URL
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}

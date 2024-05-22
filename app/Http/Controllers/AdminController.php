<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        Gate::authorize('admin');
        return view('dashboard/admin/index', [
            'posts' => Post::all()
        ]);
    }
}

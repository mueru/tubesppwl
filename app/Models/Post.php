<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    //agar field yang dimaksud tidak bisa diisi
    protected $guarded = ['id'];

    protected $with = ['category', 'author']; //setiap pemanggilan dari queri postnya, maka author dan kategorinya ikut terbawa [eager]

    //filter digunakan untuk menyaring queri yang dilakukan
    public function scopeFilter($query, array $filters) {

        //null coalescing operator ?? pengganti isset
        //ambil query, jika benar ambil search
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->whereHas('category', function($query) use ($search) {
                return $query->where('title', 'like', '%' . $search . '%') //callback function
                        ->orWhere('body', 'like', '%' . $search . '%'); 
        
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            //Query punya relationship category, kita akan melakukan callback
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category); //ambil slug category
            });
        });

        //arrow function gaperlu pake return dan kurung kurawal ()
        $query->when($filters['author'] ?? false, fn($query, $author) =>
            //tidak perlu pakai use karena scopenya otomatis mencari ke atas
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author() //memberi alias author ke user
    {
        return $this->belongsTo(User::class, 'user_id'); //tambahkan parameter baru untuk dicari idnya (foreign key) melalui fungsi author
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SkiResort;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'posts';

    protected $fillable =
    [
        'title',
        'content',
        'image',
        'user_id',
        'ski_resort_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ski_resort()
    {
        return $this->belongsTo(SkiResort::class);
    }

    //public function scopeSortByLater($query)
    //{
    //    $query->orderBy('created_at','desc');
    //}
    //
    //public function scopeSortByOlder($query)
    //{
    //    $query->orderBy('created_at','asc');
    //}

    public function scopeSortBy($query , $sortBy)
    //$request->sortからの値を$sortByで取り出す
    {
        //dd($sortBy);
        if ($sortBy === null ) {
            return $query->orderBy('posts.created_at', 'desc');
        }
        if ($sortBy == "1") {
            return $query->orderBy('posts.created_at', 'desc');
        }
        if ($sortBy == "2") {
            return $query->orderBy('posts.created_at', 'asc');
        }
    }

}

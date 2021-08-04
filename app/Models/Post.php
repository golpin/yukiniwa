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
        'id',
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

    public function like()
    {
        return $this->hasMany(Like::class);
    }

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
    public function scopeSortBySkiResort($query , $ski_resort)
    {
        if ($ski_resort !== '0') {
            return $query->where('posts.ski_resort_id', $ski_resort);
        } else {
            return;
        }
        
    }
    public function scopeSortByKeyword($query , $keyword)
    {
        
        if (!is_null($keyword)) {
            //全角スペースを半角に変換
            $spaceConvert = mb_convert_kana($keyword, 's');

            //単語を半角スペースで区切り、配列にする
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach ($keywords as $word) {
                $query->join('users', 'users.id', '=', 'posts.user_id')
                ->where('posts.title', 'like', '%' . $word . '%')
                ->orWhere('posts.content', 'like', '%' . $word . '%')
                ->orWhere('users.name', 'like', '%' . $word . '%');
            }
            return $query;
        } else {
            return;
        }
        
    }

}

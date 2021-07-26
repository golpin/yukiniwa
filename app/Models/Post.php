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

}

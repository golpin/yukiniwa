<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class SkiResort extends Model
{
    use HasFactory;

    protected $table = 'ski_resorts';

    protected $fillable = [
        'name',
        'address'
        
    ];        
    
    public function post()
    {
        return $this->hasMany(Post::class,'ski_resort_id');
    }
}

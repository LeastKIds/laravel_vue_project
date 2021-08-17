<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function imagePath() {
//        $path = '/storage/images/';
        $path = env('IMAGE_PATH' , '/storage/images/');
        $imageFile = $this -> image ?? 'default.jpeg';

        return $path.$imageFile;
    }

    public function users() {
        return $this -> belongsTo(User::class);
    }

    public function comments() {
        return $this -> hasMany(Comment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function images() {
        return $this->hasMany(Image::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public static function boot() {
        parent::boot();
        static::deleting(function (Post $post) {
            if ($post->isForceDeleting()) {
                $post->comments()->forceDelete();
            }
            else {
                $post->comments()->delete();
            }
        });
        static::restoring(function (Post $post) {
            $post->comments()->restore();
        });
    }
}

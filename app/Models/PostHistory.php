<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'posthistory_total',
    ];

    // Relationship dengan User
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    // Relationship dengan Post
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_history_id', 'id');
    }
}

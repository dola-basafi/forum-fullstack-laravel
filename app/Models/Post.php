<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    public $guarded = ['id'];

    public function user():BelongsTo{
      return $this->belongsTo(User::class);
    }

    public function category():BelongsTo{
      return $this->belongsTo(Category::class);
    }
    public function comment():HasMany{
      return $this->hasMany(Comment::class);
    }
    public function like():HasMany{
      return $this->hasMany(Like::class);
    }
}

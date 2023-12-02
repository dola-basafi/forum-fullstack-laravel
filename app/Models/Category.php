<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
  use HasFactory;

  protected $table = 'categories';
  public $guarded = ['id'];

  public function comment(): HasMany
  {
    return $this->hasMany(Post::class);
  }
}

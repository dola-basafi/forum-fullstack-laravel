<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    public $guarded = ['id'];

    function user():BelongsTo{
      return $this->belongsTo(User::class);
    }
    function post():BelongsTo{
      return $this->belongsTo(Post::class);
    }
}

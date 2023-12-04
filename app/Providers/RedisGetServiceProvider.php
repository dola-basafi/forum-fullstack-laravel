<?php

namespace App\Providers;

use App\Http\Controllers\RedisController;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;

class RedisGetServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $data = Post::with('user:id,name', 'category:id,name')->get();
    RedisController::set('all_post', $data);
  }
}

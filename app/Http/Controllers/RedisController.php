<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedisController extends Controller
{
    public static function set($key,$value){
      Cache::forever($key, $value);
    }
    public static function get($key){
      $data = Cache::get($key);
      return $data;
    }
    public static function put($key,$value){
      Cache::put($key, $value);
    }
}

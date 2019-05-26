<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


function remember($key, $minuets, $callback) {
    if ($value = Redis::get($key))
        return unserialize($value);

    Redis::setex($key, $minuets, $value = serialize($callback()));

    return $value;
}

Route::get('/', function () {
    return remember('articles.all', 60 * 60, function () {
       return \App\Article::all();
    });
});









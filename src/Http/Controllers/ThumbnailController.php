<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers;

use League\Glide\ServerFactory;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;

class ThumbnailController extends Controller
{
    public function show(Filesystem $filesystem, $path)
    {
        $source = $filesystem->getDriver();
        
        if(isset(request()->source) && request()->source == 'public')
            $source = public_path();

        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $source,
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        return $server->getImageResponse($path, request()->all());
    }
}
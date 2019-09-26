<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    public function resource(Request $request, $asset) {

        $path = $asset;
        $asset = explode('.', $asset);
        $extension = end($asset);
        $packagePath = 'package/hotcoffee/public/';

        $path = base_path($packagePath.$path);

        if (File::exists($path)) {
            $mime = '';
            if (ends_with($path, '.js')) {
                $mime = 'text/javascript';
            } elseif (ends_with($path, '.css')) {
                $mime = 'text/css';
            } else {
                $mime = File::mimeType($path);
            }
            $response = response(File::get($path), 200, ['Content-Type' => $mime]);
            $response->setSharedMaxAge(31536000);
            $response->setMaxAge(31536000);
            $response->setExpires(new \DateTime('+1 year'));
            return $response;
        }
        return response('', 404);
    }
}

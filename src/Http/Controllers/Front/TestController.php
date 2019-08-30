<?php

namespace App\Http\Controllers\Front;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller {

    public function resource(Request $request, $asset) {
        $path = $asset;//str_start(str_replace(['../', './'], '', urldecode($request->path)), '/');
        $path = base_path('package/assets/css/'.$path);

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

    public function test2($id) {
        dump($id);
    }

    public function test3() {
        echo 'test 3';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    function lunar_watermark(Request $request) {
        $data = $request->validate([
            'fileimage' => ['required', 'file'],
            'message' => ['required', 'string', 'min:10', 'max:20']
        ]);

        dd($data);
    }
}

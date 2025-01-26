<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    function lunar_watermark(Request $request)
    {
        $data = $request->validate([
            'fileimage' => ['required', 'file'],
            'message' => ['required', 'string', 'min:10', 'max:20'],
        ]);
        $font = 'C:\Windows\Fonts\Arial.ttf';

        $image = imagecreatefromstring($data['fileimage']->get());
        $luna = imagecreatefrompng(public_path('luna.png'));
        imagecopy($image, $luna, 100, 0, 0, 300, imagesx($luna) + 0, imagesy($luna) - 300);
        imagettftext($image, 25, 0, 160, 80, imagecolorallocate($image, 0, 0, 0), $font, $data['message']);

        return response()->stream(fn() => imagepng($image), 200, ['Content-Type' => 'image/png']);
    }
}

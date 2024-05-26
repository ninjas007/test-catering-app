<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function uploadFile(Request $request, string $name = 'photo', string $path = 'photo'): string
    {
        $file = $request->file($name);

        // upload photo profile
        if ($path == 'photo') {
            // Menggabungkan informasi email dengan ekstensi file asli
            $fileName = $request->email . '.' . $file->getClientOriginalExtension();
        }
        // other upload
        else {
            $fileName = $file->getClientOriginalName();
        }

        // make directory if not exists based on $name
        $directoryPath = base_path('public/img/' . $path);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // save file
        $file->move($directoryPath, $fileName);

        // return file path to show in input
        return 'img/' . $path . '/' . $fileName;
    }

    public function storeImage($request, $name, $path)
    {
        $pathFile = $this->uploadFile($request, $name, $path);
        $request->merge(['image' => $pathFile]);
    }

    public function getAvatar($request): Request
    {
        $pathFile = $this->uploadFile($request);
        $request->merge(['avatar' => $pathFile]);

        return $request;
    }
}

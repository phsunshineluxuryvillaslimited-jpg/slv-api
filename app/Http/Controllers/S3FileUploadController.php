<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class S3FileUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $origFilename = $file->getClientOriginalName();
        $folder = $request->input('folder');
        $extension = pathinfo($origFilename, PATHINFO_EXTENSION);

        $path = Storage::disk('s3')->put($folder, $file, [
            'visibility' => 'public',
            'ContentType' => $file->getClientMimeType(),
        ]);

        // Get permanent URL
        $url = Storage::disk('s3')->url($path);
        Log::info();
        return response()->json([
            'path' => $path,
            'url' => $url,
            'orig_filename' => $origFilename,
        ]);

    }
}

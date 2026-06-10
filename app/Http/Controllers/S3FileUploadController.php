<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

class S3FileUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'filename' => 'required|string',
            'type' => 'required|string',
            'folder' => 'required|string',
        ]);

        $extension = pathinfo($validated['filename'], PATHINFO_EXTENSION);

        $fileName = (string) Str::uuid() . '.' . $extension;

        $path = "{$validated['folder']}/{$fileName}";

        $s3Config = config('filesystems.disks.s3');

        $client = new S3Client([
            'version' => 'latest',
            'region' => $s3Config['region'] ?? env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => $s3Config['key'] ?? env('AWS_ACCESS_KEY_ID'),
                'secret' => $s3Config['secret'] ?? env('AWS_SECRET_ACCESS_KEY'),
            ],
            'endpoint' => $s3Config['endpoint'] ?? null,
            'use_path_style_endpoint' => $s3Config['use_path_style_endpoint'] ?? false,
        ]);

        $command = $client->getCommand('PutObject', [
            'Bucket' => $s3Config['bucket'],
            'Key' => $path,
            'ContentType' => $validated['type'],
            'ACL' => 'public-read',
        ]);

        $request = $client->createPresignedRequest($command, '+5 minutes');

        return response()->json([
            'url' => (string) $request->getUri(),
            'path' => $path,
            'file_url' => $client->getObjectUrl($s3Config['bucket'], $path),
        ]);
    }
}

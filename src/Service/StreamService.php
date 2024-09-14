<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamService
{
    public function streamAudio(string $filePath): StreamedResponse
    {
        return new StreamedResponse(function() use ($filePath) {
            $stream = fopen($filePath, 'rb');
            while(!feof($stream)) {
                echo fread($stream, 8192);
                flush();
            }
            fclose($stream);
        }, 200, [
            'Content-Type' => 'audio/mpeg',
            'Content-Length' => filesize($filePath),
            'Accept-Ranges' => 'bytes',
        ]);
    }
}

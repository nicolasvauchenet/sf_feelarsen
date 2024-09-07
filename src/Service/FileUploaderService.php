<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderService
{
    private string $uploadsDirectory;
    private Filesystem $filesystem;

    public function __construct(string $uploadsDirectory, Filesystem $filesystem)
    {
        $this->uploadsDirectory = $uploadsDirectory;
        $this->filesystem = $filesystem;
    }

    public function upload(UploadedFile $uploadedFile, string $directory, string $filename): string
    {
        $originalFilename = $filename ?: pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $originalFilename . '.' . $uploadedFile->guessExtension();
        $uploadedFile->move($this->uploadsDirectory . '/' . $directory, $fileName);

        return $fileName;
    }

    public function remove(string $directory, string $filename): void
    {
        $this->filesystem->remove($this->uploadsDirectory . '/' . $directory . '/' . $filename);
    }

    public function removeDirectory(string $directory): void
    {
        $this->filesystem->remove($this->uploadsDirectory . '/' . $directory);
    }
}

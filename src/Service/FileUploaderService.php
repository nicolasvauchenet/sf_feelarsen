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

    public function renameDirectory(string $oldDirectory, string $newDirectory): void
    {
        $oldPath = $this->uploadsDirectory . '/' . $oldDirectory;
        $newPath = $this->uploadsDirectory . '/' . $newDirectory;

        if($this->filesystem->exists($oldPath)) {
            if($this->filesystem->exists($newPath)) {
                $files = scandir($newPath);
                if(count(array_diff($files, ['.', '..'])) === 0) {
                    $this->filesystem->remove($newPath);
                } else {
                    throw new \Exception("Impossible de renommer le répertoire car le répertoire cible '$newPath' n'est pas vide.");
                }
            }

            $this->filesystem->rename($oldPath, $newPath, true);
        }
    }

    public function renameFile(string $directory, string $oldFilename, string $newFilename): void
    {
        $oldFilePath = $this->uploadsDirectory . '/' . $directory . '/' . $oldFilename;
        $newFilePath = $this->uploadsDirectory . '/' . $directory . '/' . $newFilename;

        if($this->filesystem->exists($oldFilePath)) {
            if($this->filesystem->exists($newFilePath)) {
                throw new \Exception("Impossible de renommer le fichier car le fichier cible '$newFilePath' existe déjà.");
            }

            $this->filesystem->rename($oldFilePath, $newFilePath);
        } else {
            throw new \Exception("Le fichier à renommer '$oldFilePath' n'existe pas.");
        }
    }

    public function removeDirectory(string $directory): void
    {
        $directoryPath = $this->uploadsDirectory . '/' . $directory;

        if($this->filesystem->exists($directoryPath)) {
            $this->filesystem->remove($directoryPath);
        }
    }
}

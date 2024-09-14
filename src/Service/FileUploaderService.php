<?php

namespace App\Service;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
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

    public function renameDirectory(string $oldDirectoryName, string $newDirectoryName): void
    {
        $oldPath = $this->uploadsDirectory . '/' . $oldDirectoryName;
        $newPath = $this->uploadsDirectory . '/' . $newDirectoryName;

        if(!$this->filesystem->exists($oldPath)) {
            throw new \InvalidArgumentException(sprintf('Le dossier "%s" n\'existe pas.', $oldPath));
        }

        if($this->filesystem->exists($newPath)) {
            throw new \InvalidArgumentException(sprintf('Un dossier avec le nom "%s" existe déjà.', $newPath));
        }

        try {
            $this->filesystem->rename($oldPath, $newPath);
        } catch(IOExceptionInterface $exception) {
            throw new \RuntimeException(sprintf('Erreur lors du renommage du dossier "%s" en "%s".', $oldPath, $newPath), 0, $exception);
        }
    }

    public function renameFile(string $directory, string $oldName, string $newName): string
    {
        $oldPath = $this->uploadsDirectory . '/' . $directory . '/' . $oldName;

        if(!$this->filesystem->exists($oldPath)) {
            throw new \InvalidArgumentException(sprintf('Le fichier "%s" n\'existe pas.', $oldPath));
        }

        $extension = pathinfo($oldName, PATHINFO_EXTENSION);
        $newNameWithoutExtension = pathinfo($newName, PATHINFO_FILENAME);
        $finalNewName = $newNameWithoutExtension . '.' . $extension;
        $newPath = $this->uploadsDirectory . '/' . $directory . '/' . $finalNewName;

        if($this->filesystem->exists($newPath)) {
            throw new \InvalidArgumentException(sprintf('Un fichier avec le nom "%s" existe déjà.', $newPath));
        }

        try {
            $this->filesystem->rename($oldPath, $newPath);
        } catch(IOExceptionInterface $exception) {
            throw new \RuntimeException(sprintf('Erreur lors du renommage du fichier "%s" en "%s".', $oldPath, $newPath), 0, $exception);
        }

        return $finalNewName;
    }
}

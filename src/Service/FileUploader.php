<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FileUploader
{
    public function __construct(
        #[Autowire('%kernel.project_dir%/public/pictures')]
        private string $targetDirectory,
        private SluggerInterface $slugger,
    ) {}

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = (string) $this->slugger->slug($originalFilename);
        $extension = $file->guessExtension();
        if (null === $extension) {
            throw new FileException('The uploaded image type could not be determined.');
        }

        $fileName = ('' !== $safeFilename ? $safeFilename : 'recipe').'-'.bin2hex(random_bytes(8)).'.'.$extension;
        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    public function remove(?string $fileName): void
    {
        if (null === $fileName || '' === $fileName || basename($fileName) !== $fileName) {
            return;
        }

        $path = $this->targetDirectory.DIRECTORY_SEPARATOR.$fileName;
        if (is_file($path)) {
            unlink($path);
        }
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}

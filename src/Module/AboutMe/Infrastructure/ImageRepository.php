<?php
namespace App\Module\AboutMe\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

use App\Entity\SavedUrl;
use App\Module\AboutMe\App\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(SavedUrl::class);
    }

    public function thereAreCachedImages(string $keyword): bool
    {
        $images = $this->repository->findBy([
            'keyword' => $keyword,
        ]);
        return !empty($images);
    }

    public function getCachedImages(string $keyword): array
    {
        $images = $this->repository->findBy([
            'keyword' => $keyword,
        ]);
        $urls = [];
        foreach ($images as $image)
        {
            $urls[] = $image->getUrl();
        }
        return $urls;
    }

    public function cacheImages(string $keyword, array $urls): void
    {
        foreach ($urls as $url)
        {
            $image = new SavedUrl();
            $image->setKeyword($keyword);
            $image->setUrl($url);
            $this->entityManager->persist($image);
        }
        $this->entityManager->flush();
    }

    public function pruneImageCache(): void
    {
        $images = $this->repository->findAll();
        foreach ($images as $image)
        {
            $this->entityManager->remove($image);
        }
        $this->entityManager->flush();
    }
}
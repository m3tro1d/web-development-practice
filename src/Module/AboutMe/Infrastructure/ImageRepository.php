<?php
namespace App\Module\AboutMe\Infrastructure;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

use App\Module\AboutMe\App\ImageRepositoryInterface;
use App\Module\AboutMe\Model\Image;

class ImageRepository implements ImageRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Image::class);
    }

    public function getImages(string $keyword): array
    {
        $images = $this->repository->findBy([
            'keyword' => $keyword,
        ]);
        return array_map(fn(Image $image) => $image->getUrl(), $images);
    }

    public function addImages(string $keyword, array $urls): void
    {
        foreach ($urls as $url)
        {
            $image = new Image($keyword, $url);
            $this->entityManager->persist($image);
        }
        $this->entityManager->flush();
    }

    public function deleteImages(string $keyword = ''): void
    {
        if ($keyword === '')
        {
            $images = $this->repository->findAll();
        }
        else
        {
            $images = $this->repository->findBy([
                'keyword' => $keyword,
            ]);
        }

        if (!empty($images))
        {
            array_map(fn(Image $image) => $this->entityManager->remove($image), $images);
            $this->entityManager->flush();
        }
    }
}

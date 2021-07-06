<?php

declare(strict_types=1);

namespace ShopSaas\Marketplace\Videos\Infrastructure\Persistence;

use ShopSaas\Marketplace\Videos\Domain\Video;
use ShopSaas\Marketplace\Videos\Domain\VideoId;
use ShopSaas\Marketplace\Videos\Domain\VideoRepository;
use ShopSaas\Marketplace\Videos\Domain\Videos;
use ShopSaas\Shared\Domain\Criteria\Criteria;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use ShopSaas\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class VideoRepositoryMySql extends DoctrineRepository implements VideoRepository
{
    private static array $criteriaToDoctrineFields = [
        'id'        => 'id',
        'type'      => 'type',
        'title'     => 'title',
        'url'       => 'url',
        'course_id' => 'courseId',
    ];

    public function save(Video $video): void
    {
        $this->persist($video);
    }

    public function search(VideoId $id): ?Video
    {
        return $this->repository(Video::class)->find($id);
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria, self::$criteriaToDoctrineFields);
        $videos           = $this->repository(Video::class)->matching($doctrineCriteria)->toArray();

        return new Videos($videos);
    }
}

<?php

namespace App\Sight\Infrastructure\ElasticSearch\Repository;

use App\Shared\Application\Dto\AddingResultDto;
use App\Shared\Application\Dto\ReviewDto;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;
use App\Sight\Domain\Entity\Sight;
use App\Sight\Domain\Entity\SightReview;
use App\Sight\Domain\Repository\SightReviewRepositoryInterface;

class SightReviewRepository implements SightReviewRepositoryInterface
{
    //todo Реализовать после подключения эластика и удалить моки

    public function findAllBySightId(string $sightId): array
    {
        $collection      = [];
        $data            = $this->getMockSightsReviews();
        $entityClassName = SightReview::class;
        foreach ($data as $item) {
            $object = (new TypedReflectionHydrator())->hydrate($item, $entityClassName);
            if (!$object instanceof Sight) {
                continue;
            }
            $collection[] = $object;
        }
        return $collection;
    }

    public function add(string $sightId, ReviewDto $reviewDto): AddingResultDto
    {
        $savedId = 1;
        return new AddingResultDto($savedId);
    }

    public function getMockSightsReviews()
    {
        return json_decode('[
   {
      "id":1,
      "create_at":"Ресторан «Арктика»",
      "score":"restoran-arktika",
      "text":"123,321",
      "user_name":"123,321"
   },
   {
      "id":2,
      "create_at":"Ресторан «Арктика»",
      "score":"restoran-arktika",
      "text":"123,321",
      "user_name":"123,321"
   }
]', true);
    }
}

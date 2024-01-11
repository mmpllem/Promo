<?php

namespace App\Restaurant\Infrastructure\ElasticSearch;

use App\Restaurant\Domain\Entity\Restaurant;
use App\Restaurant\Domain\Repository\RestaurantRepositoryInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    //todo Реализовать после подключения эластика и удалить моки

    public function findByCode(string $code): ?Restaurant
    {
        $data            = $this->getMockRestaurant();
        $entityClassName = Restaurant::class;

        $object = (new TypedReflectionHydrator())->hydrate($data, $entityClassName);
        if (!$object instanceof Restaurant) {
            return null;
        }
        return $object;
    }

    public function find(int $page = 1, int $limit = 99, array $filter = []): array
    {
        // TODO: Implement find() method.
        $result = [
            "list"           => [
                $this->getMockRestaurant(),
                $this->getMockRestaurant(),
                $this->getMockRestaurant(),
            ],
            "pagination"     => [],
            "filterVariants" => [],
        ];

        foreach ($result["list"] as &$restaurant) {
            $restaurant = (new TypedReflectionHydrator())->hydrate($restaurant, Restaurant::class);
        }
        return $result;
    }

    public function getMockRestaurant()
    {
        return [
            "id"         => 1,
            "name"       => "asd",
            "code"       => "fasfa",
            "type"       => ["id" => 1, "name" => "asd", "code" => "asd"],
            "settlement" => ["id" => 1, "name" => "asd", "code" => "asd", "coordinates" => "asd"],
            "kitchen"    => ["id" => 1, "name" => "asd", "code" => "asd"],
            "image"      => "src",
        ];
    }
}

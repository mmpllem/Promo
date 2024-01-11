<?php

namespace App\Settlement\Infrastructure\ElasticSearch;

use App\Settlement\Domain\Entity\Settlement;
use App\Settlement\Domain\Repository\SettlementRepositoryInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class SettlementRepository implements SettlementRepositoryInterface
{
    //todo Реализовать после подключения эластика и удалить моки

    public function findById(int $id): ?Settlement
    {
        $data            = $this->getMockSettlement();
        $entityClassName = Settlement::class;

        $object = (new TypedReflectionHydrator())->hydrate($data, $entityClassName);
        if (!$object instanceof Settlement) {
            return null;
        }
        return $object;
    }

    public function find(int $page = 1, int $limit = 99, array $filter = []): array
    {
        // TODO: Implement find() method.
        $result = [
            "list"           => [
                $this->getMockSettlement(),
                $this->getMockSettlement(),
                $this->getMockSettlement(),
            ],
            "pagination"     => [],
            "filterVariants" => [],
        ];

        foreach ($result["list"] as &$settlement) {
            $settlement = (new TypedReflectionHydrator())->hydrate($settlement, Settlement::class);
        }
        return $result;
    }

    public function getMockSettlement()
    {
        return [
            "id"          => 1,
            "name"        => "asd",
            "code"        => "asd",
            "coordinates" => "asd",
        ];
    }
}

<?php

namespace App\Sight\Infrastructure\ElasticSearch\Repository;

use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;
use App\Sight\Domain\Entity\Sight;
use App\Sight\Domain\Repository\SightRepositoryInterface;
use App\Sight\Infrastructure\ElasticSearch\Client\SearchClient;
use DEV\ElasticSearch\Criteria\Criteria;
use DEV\ElasticSearch\Criteria\Filter\Collection\FilterGroupCollection;
use DEV\ElasticSearch\Criteria\Filter\Field;
use DEV\ElasticSearch\Criteria\Filter\Filter;
use DEV\ElasticSearch\Criteria\Filter\FilterOperator;
use DEV\ElasticSearch\Criteria\Filter\Value\FilterKeyword;
use DEV\ElasticSearch\Criteria\Query\SearchQuery;
use DEV\ElasticSearch\Document\Product;
use DEV\ElasticSearch\Result;
use DEV\ElasticSearchTests\Helpers\FormatData;

class SightRepository implements SightRepositoryInterface
{
    //todo Реализовать после подключения эластика и удалить моки

    public function findByCode(string $code): ?Sight
    {
        $criteria = new Criteria();

        $criteria->getFilters()->add(
            new FilterGroupCollection(
                [
                    new Filter(
                        new Field('code_value'),
                        FilterOperator::EQ,
                        new FilterKeyword($code)
                    ),
                ]
            )
        );

        $q = new SearchQuery($criteria);

        $handler = SearchClient::getInstance();
        $result = $handler->handle($q)->result;
        dd($result->getFacets());

        $data            = $this->getMockRestaurant();
        $entityClassName = Sight::class;

        $object = (new TypedReflectionHydrator())->hydrate($data, $entityClassName);
        if (!$object instanceof Sight) {
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
        foreach ($result["list"] as &$item) {
            $item = (new TypedReflectionHydrator())->hydrate($item, Sight::class);
        }

        return $result;
    }

    public function findRandom(): ?Sight
    {
        $data            = $this->getMockRestaurant();
        $entityClassName = Sight::class;

        $object = (new TypedReflectionHydrator())->hydrate($data, $entityClassName);
        if (!$object instanceof Sight) {
            return null;
        }
        return $object;
    }


    public function getMockRestaurant()
    {
        return json_decode('{
            "id": 1,
             "name": "Ресторан «Арктика»",
             "code": "restoran-arktika",
             "coordinates": "123,321",
             "type": {
               "id": 1,
              "name": "Музей",
                "code": "kod-tipa"
             },
             "settlement": {
                "id": 2,
               "name": "Салехард",
               "code": "Salechard",
               "coordinates": "132,423"
              },
             "sightTicketInfo": {
               "id": 1,
               "price": 1000,
               "date": "12.03.2042",
              "duration": 10
             },
             "description": "<h2>Знаменитый мамонтенок Люба, мумия человека и два часа вашего времени на знакомство с тысячелетней историей  Ямала.</h2>",
             "additionalDescription": "<h2>Знаменитый мамонтенок Люба, мумия человека и два часа вашего времени на знакомство с тысячелетней историей  Ямала.</h2>",
             "check": "от 1 до 2 || от 1 || до 1000",
             "includedInCheck": [
               "Входит в стоимость"
             ],
              "phone": [
               "7999999999"
            ],
             "email": [
               "test@mail.ru"
             ],
             "address": [
               "ул.Пушкина дом Колотушкина"
             ],
             "workingHours": [
              "ПН-ПТ 09:00 - 18:00"
             ],
            "site": "https://nda.ru/",
             "image": "test.jpg",
            "sightParts": [{
              "id": 1,
               "name": "Памятник",
               "description": "<h2>Памятник</h2>",
               "image": "test.jpg"
             }]
            }', true);
    }
}

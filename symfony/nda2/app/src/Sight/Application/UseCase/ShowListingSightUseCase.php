<?php

namespace App\Sight\Application\UseCase;

use App\Sight\Application\Dto\PreviewSightDto;
use App\Sight\Domain\Service\SightListingService;
use App\Shared\Application\Dto\ListingDto;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class ShowListingSightUseCase implements UseCaseInterface
{
    private int   $page;
    private int   $limit;
    private array $filter = [];

    public function __construct(
        private readonly SightListingService $service,
        private readonly UseCaseResult       $result
    )
    {
    }

    public function setPage(int $page): static
    {
        $this->page = $page;
        return $this;
    }

    public function setLimit(int $limit): static
    {
        $this->limit = $limit;
        return $this;
    }

    public function setSettlementId(int $settlementId): static
    {
        $this->filter["settlement_id"] = $settlementId;
        return $this;
    }

    public function setRestaurantTypeId(int $sightTypeId): static
    {
        $this->filter["sight_type_id"] = $sightTypeId;
        return $this;
    }

    public function setKitchenId(int $kitchenId): static
    {
        $this->filter["kitchen_id"] = $kitchenId;
        return $this;
    }

    public function setMainPage(bool $mainPage): static
    {
        $this->filter["main_page"] = $mainPage;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $listingDto = new ListingDto($this->service->find($this->page, $this->limit, $this->filter));
        foreach ($listingDto->list as &$restaurant) {
            $restaurant = (new TypedReflectionHydrator())->hydrate($restaurant, PreviewSightDto::class);
        }
        unset($restaurant);

        $this->result->setResult($listingDto);
        return $this->result;
    }
}

<?php

namespace App\Settlement\Application\UseCase;

use App\Settlement\Application\Dto\SettlementDto;
use App\Settlement\Domain\Service\SettlementService;
use App\Shared\Application\Dto\ListingDto;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class ShowListingSettlementUseCase implements UseCaseInterface
{
    private int   $page;
    private int   $limit;
    private array $filter = [];

    public function __construct(
        private readonly SettlementService $service,
        private readonly UseCaseResult     $result,
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

    public function execute(): UseCaseResult
    {
        $listingDto = new ListingDto($this->service->find($this->page, $this->limit, $this->filter));
        foreach ($listingDto->list as &$restaurant) {
            $restaurant = (new TypedReflectionHydrator())->hydrate($restaurant, SettlementDto::class);
        }
        unset($restaurant);

        $this->result->setResult($listingDto);
        return $this->result;
    }
}

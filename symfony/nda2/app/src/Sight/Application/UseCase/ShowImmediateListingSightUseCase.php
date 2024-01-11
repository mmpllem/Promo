<?php

namespace App\Sight\Application\UseCase;

use App\Sight\Application\Dto\PreviewSightDto;
use App\Sight\Domain\Service\SightListingService;
use App\Shared\Application\Dto\ListingDto;
use App\Shared\Application\UseCase\UseCaseResult;
use App\Shared\Application\UseCase\UseCaseInterface;
use App\Shared\Infrastructure\Hydrator\TypedReflectionHydrator;

class ShowImmediateListingSightUseCase implements UseCaseInterface
{
    private int     $page        = 1;
    private int     $limit       = 10;
    private ?string $coordinates = null;

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

    public function setCoordinates(string $coordinates): static
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    public function execute(): UseCaseResult
    {
        $listingDto = new ListingDto($this->service->findByCoordinates($this->page, $this->limit, $this->coordinates));
        foreach ($listingDto->list as &$item) {
            $item = (new TypedReflectionHydrator())->hydrate($item, PreviewSightDto::class);
        }
        unset($item);
        $this->result->setResult($listingDto);
        return $this->result;
    }
}

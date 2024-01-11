<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Elasticsearch\Mapping;

use Symfony\Component\Finder\Finder;
use JsonException;

class MappingLoader
{
    public const PATH_TO_MAPPING = '/app/config/elastic';
    public const FILE_MAPPING = 'schema.json';

    private MappingCollection $collection;
    private Finder $finder;

    public function __construct() {
        $this->finder = new Finder();
    }

    /**
     * @return void
     * @throws JsonException
     */
    private function load(): void
    {
        $this->collection = new MappingCollection();

        $this->finder->files()->in(self::PATH_TO_MAPPING)->name(self::FILE_MAPPING);
        if (!$this->finder->hasResults()) {
            return;
        }

        $scheme = [];
        foreach ($this->finder as $file) {
            $scheme = json_decode($file->getContents(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new JsonException();
            }

            break;
        }

        foreach ($scheme as $index) {
            $this->collection->add(new Mapping(
                $index['index'],
                $index['mappings'],
                $index['settings'] ?? [],
            ));
        }
    }

    /**
     * @return MappingCollection
     * @throws JsonException
     */
    public function getMappings(): MappingCollection
    {
        if (!isset($this->collection)) {
            $this->load();
        }

        return $this->collection;
    }
}

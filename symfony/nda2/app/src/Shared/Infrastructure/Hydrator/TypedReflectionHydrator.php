<?php

namespace App\Shared\Infrastructure\Hydrator;

use App\Shared\Application\Collection\AbstractCollection;
use App\Shared\Application\Exception\AppException;
use BackedEnum;
use DateTime;
use Laminas\Hydrator\AbstractHydrator;
use ReflectionClass;
use ReflectionProperty;

final class TypedReflectionHydrator extends AbstractHydrator
{
    public function hydrate(array|object $data, object|string $object): object
    {
        $this->prepareData($data);
        $reflectionClass      = new ReflectionClass($object);
        $reflectionProperties = $this->getProperties($reflectionClass);
        $object               = $reflectionClass->newInstanceWithoutConstructor();
        foreach ($data as $key => $value) {
            $name = $this->hydrateName($key, $data);
            if (isset($reflectionProperties[$name])) {
                $value = $this->hydrateTypedValue($reflectionProperties[$name], $value, $data);
                $reflectionProperties[$name]->setValue($object, $value);
            }
        }
        return $object;
    }

    public function extract(object $object): array
    {
        throw new AppException("extract not implement");
    }

    private function prepareData(object|array &$data): void
    {
        if (is_array($data)) {
            return;
        }
        $convertedData            = [];
        $reflectionDataProperties = (new ReflectionClass($data))->getProperties();
        foreach ($reflectionDataProperties as $prop) {
            if ($prop->isInitialized($data)) {
                $convertedData[$prop->name] = $this->hydrateTypedValue($prop, $prop->getValue($data));
            }
        }
        $data = $convertedData;
    }

    private function getProperties(string|object $reflectionClass): array
    {
        $properties           = [];
        $reflectionProperties = $reflectionClass->getProperties();
        foreach ($reflectionProperties as $property) {
            $properties[$property->getName()] = $property;
        }
        return $properties;
    }

    private function hydrateTypedValue(ReflectionProperty $property, mixed $value, ?array $data = null): mixed
    {
        $value = $this->hydrateValue($property->getName(), $value, $data);
        if ($value === null && $property->getType() && $property->getType()->allowsNull()) {
            return null;
        }
        if ($value instanceof BackedEnum) {
            return $value;
        }
        return $this->handleTypeConversions($value, $property->getType()->getName());
    }

    private function handleTypeConversions(mixed $value, string $propertyTypeName): mixed
    {
        if ($value === null) {
            return null;
        }
        if ($this->isCollectionType($propertyTypeName)) {
            return $this->extractCollection($propertyTypeName, $value);
        }
        if ($this->isClassType($propertyTypeName)) {
            return $this->extractClass($propertyTypeName, $value);
        }
        return $this->extractDefaultValue($propertyTypeName, $value);
    }

    private function isCollectionType(string $type): bool
    {
        return is_a($type, AbstractCollection::class, true);
    }

    private function extractCollection(string $type, AbstractCollection|array $value): AbstractCollection|array
    {
        if (is_array($value)) {
            return $this->extractCollectionFromArray($type, $value);
        }

        return $this->extractArrayFromCollection($value);
    }

    private function extractCollectionFromArray(string $collectionClass, array $data): AbstractCollection
    {
        /**
         * @var $collection AbstractCollection
         */
        $collection             = new $collectionClass;
        $collectionElementClass = $collection->getType();
        foreach ($data as $item) {
            $collection->add($this->hydrate($item, $collectionElementClass));
        }
        return $collection;
    }

    private function extractArrayFromCollection(AbstractCollection $collection): array
    {
        $result = [];
        if (!$collection->isEmpty()) {
            foreach ($collection as $item) {
                $result[] = $this->hydrate($item, $collection->getDtoType());
            }
        }
        return $result;
    }

    private function isClassType(string $type): bool
    {
        return class_exists($type);
    }

    private function extractClass(string $type, mixed $value): object
    {
        return match ($type) {
            DateTime::class => $this->extractDateTime($value),
            default => $this->hydrate($value, $type),
        };
    }

    private function extractDateTime(DateTime|string|null $value): ?DateTime
    {
        if ($value === "") {
            return null;
        }
        if ($value instanceof DateTime) {
            return $value;
        }
        return new DateTime($value);
    }

    private function extractDefaultValue(string $type, mixed $value)
    {
        switch ($type) {
            case "boolean":
                $value = (bool)$value;
                break;
            case "string":
                $value = (string)$value;
                break;
            case "int":
                $value = (int)$value;
                break;
            case "float":
                $value = (float)$value;
                break;
            default:
                break;
        }
        return $value;
    }
}

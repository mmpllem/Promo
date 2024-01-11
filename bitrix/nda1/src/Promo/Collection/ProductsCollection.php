<?php

namespace App\Promo\Collection;

use ArrayObject;
use App\Entities\CatalogProduct;
use App\Promo\DTO\Product;

class ProductsCollection extends ArrayObject
{
    /**
     * @param $value
     * @return void
     */
    public function append($value): void
    {
        if ($value instanceof CatalogProduct) {
            parent::append(new Product($value));
        }
    }
}

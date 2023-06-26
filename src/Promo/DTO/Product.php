<?php

namespace App\Promo\DTO\TradeProcedures;

use App\Entities\AccrualBonuses;
use App\Entities\CatalogProduct;

class Product
{
    public int    $id;
    public int    $typeID;
    public string $typeName;
    public int    $selectedOfferId;
    public array  $offers;
    public string $name;
    public string $url;
    public float  $price;
    public float  $oldPrice;
    public int    $discount;
    public int    $bonusCount;
    public bool   $available;
    public bool   $inBasket;
    public bool   $inCompare;
    public bool   $inFavorite;
    public array  $properties;
    public array  $sizes;
    public string $picture;
    public float  $rating;
    public int    $popularity;
    public int    $reviewsCount;
    public array  $gallery;
    public array  $previewGallery;

    public function __construct(CatalogProduct $product)
    {
        $this->id              = $product->getID();
        $this->typeID          = $product->getTypeID();
        $this->typeName        = $product->getTypeName();
        $this->selectedOfferId = $product->getSelectedOfferId();
        $this->offers          = $product->getOffers();
        $this->name            = $product->getName();
        $this->url             = $product->getUrl();
        $this->price           = $product->getPrice()->get();
        $this->oldPrice        = $product->getOldPrice()->get();
        $this->discount        = $product->getDiscount();
        $this->bonusCount      = (new AccrualBonuses((float)$product->getPrice()->get()))->getAmount();
        $this->available       = $product->availability->isAvailable();
        $this->inBasket        = $product->getBasket();
        $this->inCompare       = $product->inCompare;
        $this->inFavorite      = $product->inFavorite;
        $this->properties      = $product->getProps();
        $this->sizes           = $product->getSizes();
        $this->picture         = $product->getPicture();
        $this->rating          = $product->getRating();
        $this->popularity      = $product->getPopularity();
        $this->reviewsCount    = $product->getReviewsCount();
        $this->previewGallery  = $product->getPreviewGallery();
    }
}

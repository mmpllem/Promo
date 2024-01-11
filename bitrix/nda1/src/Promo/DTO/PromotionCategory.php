<?php

namespace App\Promo\DTO\Promotions;

use App\Entities\File;

class PromotionCategory
{
    public int    $id;
    public string $name;
    public string $description;
    public string $code;
    public File   $picture;

    public function __construct(array $data)
    {
        $this->id          = (int)$data["ID"];
        $this->name        = (string)$data["NAME"];
        $this->description = (string)$data["DESCRIPTION"];
        $this->code        = (string)$data["CODE"];
        $this->picture     = new File((int)$data["PICTURE"]);
    }
}

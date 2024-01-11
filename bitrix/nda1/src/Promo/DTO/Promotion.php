<?php

namespace App\Promo\DTO\Promotions;

use App\Entities\File;

class Promotion
{
    public int               $id;
    public string            $title;
    public string            $description;
    public File              $picture;
    public string            $dateEnd;
    public string            $rules;
    public PromotionCategory $category;

    public function __construct(array $data)
    {
        $this->id          = (int)$data["ID"];
        $this->title       = (string)$data["NAME"];
        $this->description = (string)$data["PREVIEW_TEXT"];
        $this->picture     = new File((int)$data["PREVIEW_PICTURE"]);
        $this->dateEnd     = $data["ACTIVE_TO"] ? date("F j, Y G:i:s", MakeTimeStamp($data["ACTIVE_TO"])) : "";
        $this->rules       = (string)$data["DETAIL_TEXT"];
        $this->category    = $data["IBLOCK_SECTION"];
    }
}

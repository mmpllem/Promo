<?php

namespace App\Promo\DTO\TradeProcedures;

use App\Entities\File;

class TradeCategory
{
    public int       $id;
    public string    $name;
    public string    $description;
    public File      $imageDesktop;
    public File      $imageMobile;
    protected string $contact;

    public function __construct(array $data)
    {
        $this->id           = (int)$data["id"];
        $this->name         = (string)$data["name"];
        $this->description  = (string)$data["description"];
        $this->imageDesktop = new File($data["image_desktop"]);
        $this->imageMobile  = new File($data["image_mobile"]);
        $this->contact      = (string)$data["contact"];
    }

    public function getContact(): string
    {
        return $this->contact;
    }
}

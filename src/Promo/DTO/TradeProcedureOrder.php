<?php

namespace App\Promo\DTO\TradeProcedures;

class TradeProcedureOrder
{
    public string $name;
    public string $type;
    public bool   $active;

    public function __construct(array $data)
    {
        $this->name   = "Действителен до ";
        $this->type   = ((string)($data["type"] ?: "DESC"));
        $this->active = (bool)$data["active"];
    }
}

<?php

namespace App\Promo\DTO\TradeProcedures;

class TradeProcedureStatus
{
    public string $name;
    public bool   $active;
    public string $key;
    public int    $count;

    public function __construct(array $data)
    {
        $this->name   = (string)$data["name"];
        $this->active = (bool)$data["active"];
        $this->key    = (string)$data["key"];
        $this->count  = (int)$data["count"];
    }
}

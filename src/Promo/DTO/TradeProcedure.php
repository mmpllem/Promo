<?php

namespace App\Promo\DTO\TradeProcedures;

use Bitrix\Main\Type\DateTime;

class TradeProcedure
{
    protected const DATE_TIME_FORMAT = "d.m.y h:m";

    public int      $id;
    public string   $externalId;
    public string   $number;
    public int      $type;
    public string   $tradeType;
    public bool     $isOpen;
    public string   $name;
    public string   $description;
    public string   $status;
    public int      $quantity;
    public string   $unitName;
    public string   $url;
    public DateTime $dateBegin;
    public DateTime $dateEnd;
    public DateTime $dateTradeEnd;


    public function __construct(array $data)
    {
        $this->id           = (int)$data["id"];
        $this->externalId   = (string)$data["external_id"];
        $this->number       = (string)$data["number"];
        $this->type         = (int)$data["type"];
        $this->tradeType    = (string)$data["trade_type"];
        $this->isOpen       = (bool)$data["is_open"];
        $this->name         = (string)$data["name"];
        $this->description  = (string)$data["description"];
        $this->status       = (string)$data["status"];
        $this->quantity     = (int)$data["quantity"];
        $this->unitName     = (string)$data["unit_name"];
        $this->url          = (string)$data["url"];
        $this->dateBegin    = ($data["date_begin"] instanceof DateTime) ?
            $data["date_begin"] : DateTime::createFromTimestamp($data["date_begin"]);
        $this->dateEnd      = ($data["date_end"] instanceof DateTime) ?
            $data["date_end"] : DateTime::createFromTimestamp($data["date_end"]);
        $this->dateTradeEnd = ($data["date_trade_end"] instanceof DateTime) ?
            $data["date_trade_end"] : DateTime::createFromTimestamp($data["date_trade_end"]);
    }

    public function toArray(): array
    {
        return [
            "id"           => $this->id,
            "externalId"   => $this->externalId,
            "number"       => $this->number,
            "type"         => $this->type,
            "tradeType"    => $this->tradeType,
            "isOpen"       => $this->isOpen,
            "name"         => $this->name,
            "description"  => $this->description,
            "status"       => $this->status,
            "quantity"     => $this->quantity,
            "unit"         => $this->unitName,
            "url"          => $this->url,
            "dateBegin"    => $this->dateBegin->format(self::DATE_TIME_FORMAT),
            "dateEnd"      => $this->dateEnd->format(self::DATE_TIME_FORMAT),
            "dateTradeEnd" => $this->dateTradeEnd->format(self::DATE_TIME_FORMAT),
        ];
    }
}

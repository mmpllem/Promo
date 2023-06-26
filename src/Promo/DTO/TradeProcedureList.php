<?php

namespace App\Promo\DTO\TradeProcedures;

class TradeProcedureList
{
    public array $tradeList;
    public array $pageNavigation;
    public array $orderVariants;
    public array $availableStatuses;

    public function __construct(array $data)
    {
        $this->tradeList         = is_array($data["trade_list"]) ? $data["trade_list"] : [];
        $this->pageNavigation    = is_array($data["page_navigation"]) ? $data["page_navigation"] : [];
        $this->orderVariants     = is_array($data["order_variants"]) ? $data["order_variants"] : [];
        $this->availableStatuses = is_array($data["available_statuses"]) ? $data["available_statuses"] : [];
    }
}

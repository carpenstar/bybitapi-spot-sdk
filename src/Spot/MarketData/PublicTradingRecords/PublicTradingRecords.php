<?php

namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Enums\EnumHttpMethods;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Response\PublicTradingRecordsResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Request\PublicTradingRecordsRequest;

/**
 * https://bybit-exchange.github.io/docs/spot/public/recent-trade
 */
class PublicTradingRecords extends PublicEndpoint
{
    public function getEndpointRequestMethod(): string
    {
        return EnumHttpMethods::GET;
    }

    protected function getEndpointUrl(): string
    {
        return "/spot/v3/public/quote/trades";
    }

    protected function getResponseClassnameByCondition(array &$apiData = null): string
    {
        return PublicTradingRecordsResponse::class;
    }

    protected function getRequestClassname(): string
    {
        return PublicTradingRecordsRequest::class;
    }
}

<?php

namespace Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Enums\EnumHttpMethods;
use Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Request\AllAssetInfoRequest;
use Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Response\AllAssetInfoResponse;

class AllAssetInfo extends PublicEndpoint
{
    public function getEndpointRequestMethod(): string
    {
        return EnumHttpMethods::GET;
    }

    protected function getEndpointUrl(): string
    {
        return "/spot/v3/public/infos";
    }

    protected function getResponseClassnameByCondition(array &$apiData = null): string
    {
        return AllAssetInfoResponse::class;
    }

    protected function getRequestClassname(): string
    {
        return AllAssetInfoRequest::class;
    }
}

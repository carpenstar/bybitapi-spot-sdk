<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\BestBidAskPrice;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Response\BestBidAskPriceResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Request\BestBidAskPriceRequestOptions;
use PHPUnit\Framework\TestCase;

class BestBidAskPriceTest extends TestCase
{
    private static string $bestBidAskApiResponse = '{"retCode":0,"retMsg":"OK","result":{"symbol":"BTCUSDT","bidPrice":"26298.69","bidQty":"0.106418","askPrice":"26298.7","askQty":"0.008773","time":1683979447464},"retExtInfo":{},"time":1683979447820}';

    public function testBestBidAskRequest()
    {
        $bestBidAskEndpoint = RestBuilder::make(BestBidAskPrice::class, (new BestBidAskPriceRequestOptions())->setSymbol('BTCUSDT'));

        $reflectionWalletEndpoint = new \ReflectionClass($bestBidAskEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseClassname');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($bestBidAskEndpoint, []);
        $this->assertEquals(BestBidAskPriceResponse::class, $checkMethodResult);
    }

    public function testBestBidAskResponse()
    {
        $bestBidAskResponseData = (new CurlResponse(self::$bestBidAskApiResponse))
            ->bindEntity(BestBidAskPriceResponse::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $bestBidAskResponseData->getBody());

        $this->assertNotEquals(0, $bestBidAskResponseData->getBody()->count());

        /** @var BestBidAskPriceResponse $checkItem */
        $bestBisAsk = $bestBidAskResponseData->getBody()->fetch();
        $this->assertInstanceOf(BestBidAskPriceResponse::class, $bestBisAsk);
        $this->assertIsString($bestBisAsk->getSymbol());
        $this->assertIsFloat($bestBisAsk->getAskPrice());
        $this->assertIsFloat($bestBisAsk->getBidPrice());
        $this->assertIsFloat($bestBisAsk->getAskQty());
        $this->assertIsFloat($bestBisAsk->getBidQty());
        $this->assertInstanceOf(\DateTime::class, $bestBisAsk->getTime());
    }
}
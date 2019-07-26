<?php
namespace WojciechM\Weather\Api;

use Magento\Framework\App\Request\Http;
use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\Serialize\Serializer\Json;

class WeatherApi
{
    //todo more security checking etc, but keep it simple, split const conf into configuration file
    const REQUEST_TIMEOUT = 2000;
    const END_POINT_URL = 'api.openweathermap.org/data/2.5/weather?q=Lublin,pl&lang=pl&units=metric';
    const API_KEY = '4fb738f0b2a9328569c66c8203c14f8b';

    private $response;

    /**
     * @var CurlFactory
     */
    private $curlFactory;

    /**
     * @var Http
     */
    private $http;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    private $jsonHelper;

    /**
     * Weather constructor.
     * @param CurlFactory $curlFactory
     * @param Http $http
     * @param Json
     */
    public function __construct(CurlFactory $curlFactory, Http $http, Json $jsonHelper)
    {
        $this->curlFactory = $curlFactory;
        $this->http = $http;
        $this->jsonHelper = $jsonHelper;
    }


    public function getWeatherResponse()
    {
        if(!$this->response){
            $this->response = $this->getResponseFromEndPoint();
        }
        return $this->response;
    }


    private function getResponseFromEndPoint()
    {
        return $this->jsonHelper->unserialize($this->getResponse());
    }

    private function getResponse()
    {
        /** @var \Magento\Framework\HTTP\Client\Curl $client */
        $client = $this->curlFactory->create();
        $client->setTimeout(self::REQUEST_TIMEOUT);
        $client->get(
            self::END_POINT_URL . '&APPID=' . self::API_KEY
        );

        return $client->getBody();
    }
}
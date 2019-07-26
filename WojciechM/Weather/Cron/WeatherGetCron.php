<?php

namespace WojciechM\Weather\Cron;

use DateTime;
use Throwable;
use WojciechM\Weather\Api\WeatherApi;
use WojciechM\Weather\Model\WeatherFactory;
use Zend\Log\Logger;
use \Zend\Log\Writer\Stream;
use Magento\Framework\App\ObjectManager;

class WeatherGetCron
{

    /** @var WeatherApi */
    private $weatherApi;

    /**
     * @var WeatherFactory
     */
    private $weatherModel;

    /**
     * WeatherFooterBlock constructor.
     * @param WeatherFactory $weatherFactory
     */
    public function __construct(WeatherFactory $weatherFactory)
    {
        $this->weatherModel = $weatherFactory->create();
    }

    /**
     * @return void
     */
    public function execute()
    {
        try {
            $result = $this->weatherApi()->getWeatherResponse();
            $logger = new Logger();
            $logger->addWriter(new Stream(BP . '/var/log/cron.log'));
            $logger->info('Got Weather Data !');

            //todo add description by UpdateSchema
//            $result['weather'][0]['description'];
            //todo create ModelRepository, checking, parsing data and saving by not deprecated method
            $now = new DateTime("now");
            $this->weatherModel->addData([
                "temp_min" => $result['main']['temp_min'],
                "temp_max" => $result['main']['temp_max'],
                "pressure" =>  $result['main']['pressure'],
                "humidity" => $result['main']['humidity'],
                "wind_speed" => $result['wind']['speed'],
                "clouds" => $result['clouds']['all'],
                "created_at" => $now->format('Y-m-d H:i:s'),
            ]);
            $this->weatherModel->save();



        } catch (Throwable $e) {
            $logger = new Logger();
            $logger->addWriter(new Stream(BP . '/var/log/cron.log'));
            $logger->err('THROWABLE when getting weather data by api! ' . $e->getMessage());
        }
    }

    /**
     * get weather api object
     * @return WeatherApi
     */
    private function weatherApi(): WeatherApi
    {
        if (!$this->weatherApi) {
            $this->weatherApi = ObjectManager::getInstance()->get(WeatherApi::class);
        }

        return $this->weatherApi;
    }

}

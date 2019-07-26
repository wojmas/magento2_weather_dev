<?php

namespace WojciechM\Weather\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;
use Magento\Framework\App\ObjectManager;
use Throwable;
use WojciechM\Weather\Api\WeatherApiFactory;
use WojciechM\Weather\Api\WeatherApi;


class WeatherGetCommand extends Command
{

    /** @var WeatherApi */
    private $weatherApi;

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('weather:get');
        $this->setDescription('Get weather data from openweathermap.org ');

        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $result = $this->weatherApi()->getWeatherResponse();
            var_dump($result);
            $output->writeln('Got Weather Data');
        } catch (Exception $e) {
            $output->writeln('Error: ' . $e->getMessage());
        } catch (Throwable $e) {
            $output->writeln('Throwable: ' . $e->getMessage());
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

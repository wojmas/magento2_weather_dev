<?php

namespace WojciechM\Weather\Block;

use Magento\Framework\View\Element\Template;
use WojciechM\Weather\Model\WeatherFactory;

class WeatherFooterBlock extends Template
{
    /**
     * @var WeatherFactory
     */
    private $weatherModel;

    /**
     * WeatherFooterBlock constructor.
     * @param Template\Context $context
     * @param WeatherFactory $weatherFactory
     * @param array $data
     */
    public function __construct(Template\Context $context, WeatherFactory $weatherFactory,  array $data = [])
    {
        parent::__construct($context, $data);
        $this->weatherModel = $weatherFactory->create();
    }

    /**
     * @return array
     */
    public function getActualWeather()
    {
        //todo refactor to use collection factory this is deprecated, add repository
        $collection = $this->weatherModel
            ->getCollection()
            ->setOrder('id', 'DESC');

        return $collection->getSize() ? $collection->getFirstItem() : null;
    }
}

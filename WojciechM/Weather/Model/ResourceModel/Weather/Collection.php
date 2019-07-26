<?php
namespace  WojciechM\Weather\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'weather_city_lublin_collection';
    protected $_eventObject = 'weather_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        //future for admin grid
        $this->_init(\WojciechM\Weather\Model\Weather::class, \WojciechM\Weather\Model\ResourceModel\Weather::class);
    }

}


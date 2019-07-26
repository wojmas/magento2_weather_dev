<?php
namespace WojciechM\Weather\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Weather extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'weather_city_lublin';

    protected $_cacheTag = 'weather_city_lublin';

    protected $_eventPrefix = 'weather_city_lublin';

    protected function _construct()
    {
        $this->_init(\WojciechM\Weather\Model\ResourceModel\Weather::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}

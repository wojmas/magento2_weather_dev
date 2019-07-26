<?php

namespace WojciechM\Weather\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
	public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
        $setup->startSetup();
        $setup->getConnection()->dropTable($setup->getTable('weather_city_lublin'));
        $setup->endSetup();
	}

}

<?php

namespace WojciechM\Weather\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\InstallSchemaInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws Zend_Db_Exception
     */
    public function install (SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();
        $tableName = $setup->getTable('weather_city_lublin');

        if (!$connection->isTableExists($tableName)) {
            $connection->createTable($connection->newTable($tableName)
                ->addColumn('id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary'  => true,
                ])
                ->addColumn('temp_min', Table::TYPE_TEXT, 10, [
                    'nullable' => true,
                ])
                ->addColumn('temp_max', Table::TYPE_TEXT, 10, [
                    'nullable' => true,
                ])
                ->addColumn('pressure', Table::TYPE_TEXT, 10, [
                    'nullable' => true,
                ])
                ->addColumn('clouds', Table::TYPE_TEXT, 10, [
                    'nullable' => true,
                ])
                ->addColumn('humidity', Table::TYPE_TEXT, 10, [
                    'nullable' => true,
                ])
                ->addColumn('wind_speed', Table::TYPE_TEXT, 10, [
                    'nullable' => true,
                ])
                ->addColumn('clouds', Table::TYPE_TEXT, 10, [
                    'nullable' => true,
                ])
                ->addColumn('created_at', Table::TYPE_DATETIME, 255, [
                    'nullable' => false,
                ])
                ->setOption('charset','utf8'));
        }

        $setup->endSetup();
    }

}

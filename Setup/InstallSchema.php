<?php

namespace Magentotest\Tasks\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Magentotest\Tasks\Setup
 */
class InstallSchema implements InstallSchemaInterface {
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = $installer->getTable('tasks');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'auto_increment' => true,
                        'primary' => true,
                        'nullable' => false
                    ],
                    'ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'length' => 255
                    ],
                    'Title'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'default' => 'New'
                    ],
                    'Status'
                )
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
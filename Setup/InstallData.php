<?php

namespace Magentotest\Tasks\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Magentotest\Tasks\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Install messages
         */
        $statuses = ['New', 'Assigned', 'Resolved', 'Feedback', 'Closed', 'Rejected'];
        $i = 1;
        while ($i <= 10) {
            $data = [
                'title' => 'Task number ' . $i,
                'status' => $statuses[rand(0, count($statuses) - 1)]
            ];
            $setup->getConnection()->insertForce($setup->getTable('tasks'), $data);
            $i++;
        }
    }
}
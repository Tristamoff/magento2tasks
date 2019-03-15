<?php

namespace Magentotest\Tasks\Model\Resource\Task;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Magentotest\Tasks\Model\Resource\Task
 */
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Magentotest\Tasks\Model\Task',
            'Magentotest\Tasks\Model\Resource\Task'
        );
    }
}
<?php

namespace Magentotest\Tasks\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Task
 * @package Magentotest\Tasks\Model
 */
class Task extends AbstractModel {
    /**
     * Define task model.
     */
    protected function _construct()
    {
        $this->_init('Magentotest\Tasks\Model\Resource\Task');
    }
}
<?php

namespace Magentotest\Tasks\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Task
 * @package Magentotest\Tasks\Model\Resource
 */
class Task extends AbstractDb {
   /**
    * Define model task
    */
   protected function _construct()
   {
       $this->_init('tasks', 'id');
   }
}


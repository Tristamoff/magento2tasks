<?php

namespace Magentotest\Tasks\Model;

use Magentotest\Tasks\Model\Resource\Task\CollectionFactory;

/**
 * Class DataProvider
 * @package Magentotest\Tasks\Model
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $taskCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $taskCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $taskCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if(isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $items = $this->collection->getItems();

        foreach($items as $contact)
        {
            $this->_loadedData[$contact->getId()] = $contact->getData();
        }
        return $this->_loadedData;
    }
}
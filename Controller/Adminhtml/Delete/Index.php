<?php

namespace Magentotest\Tasks\Controller\Adminhtml\Delete;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Magentotest\Tasks\Controller\Adminhtml\Delete
 */
class Index extends Action
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        parent::__construct($context);
        $this->_objectManager = $objectManager;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id', 0);

        $task = $this->_objectManager->create('Magentotest\Tasks\Model\Task');
        if ($id > 0) {
            $task = $task->load($id);
            $task->delete();
        }

        // Model was deleted
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('*/index/index');
        return $redirect;
    }
}
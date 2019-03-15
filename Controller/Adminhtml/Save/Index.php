<?php

namespace Magentotest\Tasks\Controller\Adminhtml\Save;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Magentotest\Tasks\Controller\Adminhtml\Save
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
        $title = $this->getRequest()->getParam('title', 'Default title');
        $status = $this->getRequest()->getParam('status', 1);

        $task = $this->_objectManager->create('Magentotest\Tasks\Model\Task');
        if ($id > 0) {
            // If this is model editing
            $task = $task->load($id);
        }
        $task->setTitle($title);
        $task->setStatus($status);
        $task->save();

        if ($task->getId()) {
            // Model was saved
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('*/index/index');
            return $redirect;
        }
    }
}
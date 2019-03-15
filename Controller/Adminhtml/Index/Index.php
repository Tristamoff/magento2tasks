<?php

namespace Magentotest\Tasks\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\UrlInterface;
use Magentotest\Tasks\Model\TaskFactory;

/**
 * Class Index
 * @package Magentotest\Tasks\Controller\Adminhtml\Index
 */
class Index extends Action
{
    /**
     * @var \Magentotest\Tasks\Model\TaskFactory
     */
    protected $_modelTaskFactory;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param UrlInterface $urlBuilder
     * @param TaskFactory $modelTaskFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        TaskFactory $modelTaskFactory
    ) {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_urlBuilder = $urlBuilder;
        $this->_modelTaskFactory = $modelTaskFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $taskModel = $this->_modelTaskFactory->create();

        // Get tasks collection
        $taskCollection = $taskModel->getCollection();
        $tasks = $taskCollection->getData();
        if (!empty($tasks)) {
            foreach ($tasks as $i => $task) {
                $edit_link = $this->_urlBuilder->getUrl('*/edit', ['id' => $task['id']]);
                $tasks[$i]['edit_link'] = $edit_link;
                $delete_link = $this->_urlBuilder->getUrl('*/delete', ['id' => $task['id']]);
                $tasks[$i]['delete_link'] = $delete_link;
            }
        }

        $resultPage = $this->_pageFactory->create();
        $resultPage->getLayout()->getBlock('tasks_list')->setTasks($tasks);
        return $resultPage;
    }
}
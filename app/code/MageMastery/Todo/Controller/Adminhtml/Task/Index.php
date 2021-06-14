<?php

namespace MageMastery\Todo\Controller\Adminhtml\Task;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = '';

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('TODO List'));

        return $resultPage;
    }
}

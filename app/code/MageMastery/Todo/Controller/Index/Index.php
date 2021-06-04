<?php
declare(strict_types=1);

namespace MageMastery\Todo\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package MageMastery\Todo\Controller\Index
 */
class Index extends Action
{
    /**
     * @var Session
     */
    private         $session;

    /**
     * Index constructor.
     * @param  Context  $context
     * @param  Session  $session
     */
    public function __construct(Context $context, Session $session)
    {
        $this->session = $session;
        parent::__construct($context);
    }

    public function execute()
    {
        if(!$this->session->isLoggedIn()) {

            /** @var Redirect $redirection */
            $redirection = $this->resultFactory->create(
                ResultFactory::TYPE_REDIRECT
            );
            $redirection->setPath('customer/account/login');
            return $redirection;
        }

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

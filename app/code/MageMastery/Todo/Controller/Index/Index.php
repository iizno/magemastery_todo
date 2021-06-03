<?php


namespace MageMastery\Todo\Controller\Index;


use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Service\TaskRepository;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use MageMastery\Todo\Model\Task;
use MageMastery\Todo\Model\ResourceModel\Task as TaskResource;
use MageMastery\Todo\Model\TaskFactory;

/**
 * Class Index
 * @package MageMastery\Todo\Controller\Index
 */
class Index extends Action
{
    /**
     * @var TaskResource
     */
    private $task_resource;

    /**
     * @var TaskFactory
     */
    private $task_factory;

    /**
     * @var TaskRepository
     */
    private $task_repository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteria;

    /**
     * @var TaskManagementInterface
     */
    private $taskManagement;

    /**
     * Index constructor.
     * @param  Context                  $context
     * @param  TaskFactory              $task_factory
     * @param  TaskResource             $task_resource
     * @param  TaskRepository           $task_repository
     * @param  SearchCriteriaBuilder    $searchCriteria
     * @param  TaskManagementInterface  $taskManagement
     */
    public function __construct(
        Context $context,
        TaskFactory $task_factory,
        TaskResource $task_resource,
        TaskRepository $task_repository,
        SearchCriteriaBuilder $searchCriteria,
        TaskManagementInterface $taskManagement
    ) {
        $this->task_resource = $task_resource;
        $this->task_factory  = $task_factory;
        $this->task_repository  = $task_repository;
        $this->searchCriteria  = $searchCriteria;
        $this->taskManagement  = $taskManagement;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page|void
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

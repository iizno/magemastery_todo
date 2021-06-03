<?php

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use MageMastery\Todo\Model\TaskFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    private $resource;

    /**
     * @var TaskFactory;
     */
    private $task_factory;

    private $searchResultsFactory;
    private $collectionProcessor;

    public function __construct(
        Task $resource,
        TaskFactory $task_factory,
        CollectionProcessorInterface $collectionProcessor,
        TaskSearchResultInterfaceFactory $taskSearchResultInterfaceFactory
    ) {
        $this->resource = $resource;
        $this->task_factory = $task_factory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $taskSearchResultInterfaceFactory;
    }

    /**
     * @param  int  $task_id
     * @return \MageMastery\Todo\Api\Data\TaskInterface|\MageMastery\Todo\Model\Task
     */
    public function get(int $task_id) : TaskInterface
    {
        $object = $this->task_factory->create();
        $this->resource->load($object, $task_id);
        return $object;
    }

    public function getList(SearchCriteriaInterface $search_criteria): TaskSearchResultInterface
    {
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($search_criteria);

        $this->collectionProcessor->process($search_criteria, $searchResult);

        return $searchResult;
    }
}

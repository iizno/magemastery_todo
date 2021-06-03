<?php
declare(strict_types=1);

namespace MageMastery\Todo\Service;


use MageMastery\Todo\Api\CustomerTaskListInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CustomerTaskList implements CustomerTaskListInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return \MageMastery\Todo\Api\Data\TaskInterface[]
     */
    public function getList()
    {
        return $this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }
}

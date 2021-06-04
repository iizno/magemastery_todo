<?php
declare(strict_types=1);

namespace MageMastery\Todo\Service;


use MageMastery\Todo\Api\CustomerTaskListInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

class CustomerTaskList implements CustomerTaskListInterface
{
    private TaskRepositoryInterface $taskRepository;
    private SearchCriteriaBuilder   $searchCriteriaBuilder;
    private FilterBuilder           $filterBuilder;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder
    ) {
        $this->taskRepository        = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder         = $filterBuilder;
    }

    /**
     * @param  int  $customerId
     * @return \MageMastery\Todo\Api\Data\TaskInterface[]
     */
    public function getList(int $customerId): array
    {
        $this->searchCriteriaBuilder->addFilter(
            $this->filterBuilder->create()
                                ->setField('customer_id')
                                ->setValue($customerId)
        );
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->taskRepository
            ->getList($searchCriteria)
            ->getItems();
    }
}

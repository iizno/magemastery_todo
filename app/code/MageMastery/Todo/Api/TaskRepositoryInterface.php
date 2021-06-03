<?php

namespace MageMastery\Todo\Api;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    /**
     * @param  SearchCriteriaInterface  $search_criteria
     * @return TaskSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $search_criteria): TaskSearchResultInterface;

    /**
     * @param  int  $task_id
     * @return TaskInterface
     */
    public function get(int $task_id): TaskInterface;
}

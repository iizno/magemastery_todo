<?php

namespace MageMastery\Todo\Model\ResourceModel\Task;

use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use MageMastery\Todo\Model\Task;
use MageMastery\Todo\Model\ResourceModel\Task as TaskResource;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection implements TaskSearchResultInterface
{
    private $searchCriteria;

    protected function _construct()
    {
        $this->_init(Task::class, TaskResource::class);
    }

    /**
     * @param  SearchCriteriaInterface  $searchCriteria
     * @return $this|Collection
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    public function getTotalCount()
    {
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        return $this;
    }

    public function setItems(array $items)
    {
        if(!$items) {
            return $this;
        }

        foreach($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }
}

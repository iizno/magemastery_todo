<?php
declare(strict_types=1);

namespace MageMastery\Todo\Service;


use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use Magento\Framework\Exception\AlreadyExistsException;

class TaskManagement implements TaskManagementInterface
{
    /**
     * @var
     */
    private $resource;

    /**
     * TaskManagement constructor.
     * @param  Task  $resource
     */
    public function __construct(
        Task $resource
    )
    {
        $this->resource = $resource;
    }

    /**
     * @param  int            $customerId
     * @param  TaskInterface  $task
     * @return int
     * @throws AlreadyExistsException
     */
    public function save(int $customerId, TaskInterface $task): int
    {
        $task->setData('customer_id', $customerId);
        $this->resource->save($task);
        return $task->getTaskId();
    }

    /**
     * @param  int            $customerId
     * @param  TaskInterface  $task
     * @return bool
     * @throws \Exception
     */
    public function delete(int $customerId, TaskInterface $task): bool
    {
        $task->setData('customer_id', $customerId);
        $this->resource->delete($task);
        return true;
    }
}

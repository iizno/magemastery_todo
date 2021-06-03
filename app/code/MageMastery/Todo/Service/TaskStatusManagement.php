<?php

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Api\TaskStatusManagementInterface;
use MageMastery\Todo\Model\Task;

class TaskStatusManagement implements TaskStatusManagementInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $repository;

    /**
     * @var TaskManagementInterface
     */
    private $taskManagement;

    /**
     * TaskStatusManagement constructor.
     * @param  TaskRepositoryInterface  $repository
     * @param  TaskManagementInterface  $taskManagement
     */
    public function __construct(
        TaskRepositoryInterface $repository,
        TaskManagementInterface $taskManagement
    )
    {
        $this->repository = $repository;
        $this->taskManagement = $taskManagement;
    }

    /**
     * @param  int     $taskId
     * @param  string  $status
     * @return bool
     */
    public function change(int $taskId, string $status): bool
    {
        if(!in_array($status, ['open', 'complete'])) {
            return false;
        }

        $task = $this->repository->get($taskId);
        $task->setData(Task::TASK_STATUS, $status);

        $this->taskManagement->save($task);
        return true;
    }


    public function get()
    {
        // TODO: Implement get() method.
    }
}

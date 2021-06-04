<?php

declare(strict_types=1);

namespace MageMastery\Todo\Api;

use MageMastery\Todo\Api\Data\TaskInterface;

/**
 * @api
 */
interface TaskManagementInterface
{
    /**
     * @param  int            $customerId
     * @param  TaskInterface  $task
     * @return int
     */
    public function save(int $customerId, TaskInterface $task) : int;

    /**
     * @param  int            $customerId
     * @param  TaskInterface  $task
     * @return bool
     */
    public function delete(int $customerId, TaskInterface $task) : bool;
}

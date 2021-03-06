<?php
declare(strict_types=1);

namespace MageMastery\Todo\Api;

/**
 * @api
 */
interface TaskStatusManagementInterface
{
    /**
     * @param  int     $customerId
     * @param  int     $taskId
     * @param  string  $status
     * @return bool
     */
    public function change(int $customerId, int $taskId, string $status): bool;

    /**
     * @return mixed
     */
    public function get();
}

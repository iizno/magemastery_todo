<?php
declare(strict_types=1);
namespace MageMastery\Todo\Api\Data;

/**
 * @api
 */
interface TaskInterface {
    /**
     * @return int
     */
    public function getTaskId(): int;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param  int  $taskId
     * @return mixed
     */
    public function setTaskId(int $taskId);

    /**
     * @param  string  $status
     * @return mixed
     */
    public function setStatus(string $status);

    /**
     * @param  string  $label
     * @return mixed
     */
    public function setLabel(string $label);
}

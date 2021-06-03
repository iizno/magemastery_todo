<?php

namespace MageMastery\Todo\Model;

use MageMastery\Todo\Api\Data\TaskInterface;
use Magento\Framework\Model\AbstractModel;
use MageMastery\Todo\Model\ResourceModel\Task as TaskResource;

/**
 * Class Task
 * @package MageMastery\Todo\Model
 */
class Task extends AbstractModel implements TaskInterface
{
    /**
     *
     */
    const TASK_ID     = "task_id";
    /**
     *
     */
    const TASK_STATUS = "status";
    /**
     *
     */
    const TASK_LABEL = "label";

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(TaskResource::class);
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return (int) $this->getData(self::TASK_ID);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->getData(self::TASK_STATUS);
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->getData(self::TASK_LABEL);
    }

    /**
     * @param  int  $taskId
     * @return mixed|void
     */
    public function setTaskId(int $taskId)
    {
        $this->setData(self::TASK_ID, $taskId);
    }

    /**
     * @param  string  $status
     * @return mixed|void
     */
    public function setStatus(string $status)
    {
        $this->setData(self::TASK_STATUS, $status);
    }

    /**
     * @param  string  $label
     * @return mixed|void
     */
    public function setLabel(string $label)
    {
        $this->setData(self::TASK_LABEL, $label);
    }


}

<?php

namespace MageMastery\Todo\Api;


use MageMastery\Todo\Api\Data\TaskInterface;

interface CustomerTaskListInterface
{
    /**
     * @return TaskInterface[];
     */
    public function getList();
}

<?php

namespace MageMastery\Todo\Api;


use MageMastery\Todo\Api\Data\TaskInterface;

interface CustomerTaskListInterface
{
    /**
     * @param  int  $customerId
     * @return TaskInterface[];
     */
    public function getList(int $customerId);
}

<?php


namespace MageMastery\Todo\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use MageMastery\Todo\Model\Task;
use MageMastery\Todo\Model\ResourceModel\Task as TaskResource;
use MageMastery\Todo\Model\TaskFactory;

class Index extends Action
{
    private $task_resource;
    private $task_factory;

    public function __construct(Context $context, TaskFactory $task_factory, TaskResource $task_resource)
    {
        $this->task_resource = $task_resource;
        $this->task_factory  = $task_factory;

        parent::__construct($context);
    }

    public function execute()
    {
        $task = $this->task_factory->create();

        $task->setData([
           'label'       => 'New Task 22',
           'status'      => 'open',
           'customer_id' => 1,
       ]);

        $this->task_resource->save($task);

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

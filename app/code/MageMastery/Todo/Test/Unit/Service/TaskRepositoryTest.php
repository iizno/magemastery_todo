<?php

declare(strict_types=1);

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use MageMastery\Todo\Model\ResourceModel\Task;
use MageMastery\Todo\Model\TaskFactory;
use MageMastery\Todo\Service\TaskRepository;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TaskRepositoryTest extends TestCase
{
    /**
     * @var TaskInterface|MockObject
     */
    private $task1;

    /**
     * @var TaskInterface|MockObject
     */
    private $task2;

    /**
     * @var Task|MockObject
     */
    private $taskRessourceModel;

    /**
     * @var TaskFactory|MockObject
     */
    private $task_factory;
    /**
     * @var MockObject|SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var SearchCriteria|MockObject
     */
    private $searchCriteria;
    /**
     * @var CollectionProcessorInterface|MockObject
     */
    private $collectionProcessor;
    /**
     * @var TaskSearchResultInterfaceFactory|MockObject
     */
    private $taskSearchResultInterfaceFactory;

    protected function setUp(): void
    {
        $this->task1 = $this->getMockBuilder(\MageMastery\Todo\Model\Task::class)
                            ->disableOriginalConstructor()
                            ->onlyMethods(['getTaskId'])
                            ->getMock();

        $this->task1->expects($this->any())
                    ->method('getTaskId')
                    ->willReturn(1);

        $this->searchCriteriaBuilder = $this->getMockBuilder(SearchCriteriaBuilder::class)
                                            ->disableOriginalConstructor()
                                            ->onlyMethods(['create'])
                                            ->getMock();

        $this->searchCriteria = $this->getMockBuilder(SearchCriteria::class)
                                     ->disableOriginalConstructor()
                                     ->getMock();

        $this->taskRessourceModel = $this->getMockBuilder(Task::class)
                                         ->disableOriginalConstructor()
                                         ->getMock();

        $this->taskRessourceModel->expects($this->any())
                                 ->method('load')
                                 ->with($this->task1, $this->task1->getTaskId())
                                 ->willReturn($this->task1);

        $this->task_factory = $this->getMockBuilder(TaskFactory::class)
                                   ->onlyMethods(['create'])
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->task_factory->expects($this->any())
                           ->method('create')
                           ->willReturn($this->task1);

        $this->taskSearchResultInterfaceFactory = $this->getMockBuilder(TaskSearchResultInterfaceFactory::class)
                                                       ->disableOriginalConstructor()
                                                       ->getMock();

        $this->collectionProcessor = $this->getMockForAbstractClass(
            CollectionProcessorInterface::class,
            [],
            '',
            false,
            false,
            true,
            ['process']
        );
    }

    public function testGet()
    {
        $object = new TaskRepository(
            $this->taskRessourceModel,
            $this->task_factory,
            $this->collectionProcessor,
            $this->taskSearchResultInterfaceFactory
        );

        $expected_task_1 = $object->get(1);

        $this->assertEquals($this->task1, $expected_task_1);
    }
}

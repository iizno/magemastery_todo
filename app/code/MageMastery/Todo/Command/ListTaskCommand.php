<?php
declare(strict_types=1);

namespace MageMastery\Todo\Command;

use MageMastery\Todo\Api\TaskRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListTaskCommand extends \Symfony\Component\Console\Command\Command
{
    const NAME = "magemastery:todo:task-list";

    private TaskRepositoryInterface $taskRepository;
    private SearchCriteriaBuilder   $searchCriteriaBuilder;
    private ?string                 $name;
    private FilterBuilder           $filterBuilder;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        string $name = null)
    {
        $this->taskRepository        = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName(self::NAME)
             ->setDescription(
                 'Provide a list of tasks'
             )->addOption('customer_id', 'c', InputOption::VALUE_OPTIONAL, 'Filter task for this customer');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customerId = (int) $input->getOption('customer_id');

        if(!empty($customerId)) {
            $this->searchCriteriaBuilder->addFilter(
               'customer_id', $customerId
            );
        }

        $search_result = $this->taskRepository->getList($this->searchCriteriaBuilder->create());
        $tasks = $search_result->getItems();

        $table = new Table($output);

        $rows = [];

        $table->setHeaders(['ID', 'Label', 'Status', 'Customer ID']);

        foreach($tasks as $task) {
            $rows[] = [
                $task->getTaskId(),
                $task->getLabel(),
                $task->getStatus(),
                $task->getData('customer_id')
            ];
        }

        $table->setStyle('symfony-style-guide');
        $table->setRows($rows);
        $table->render();

        return Cli::RETURN_SUCCESS;
    }
}

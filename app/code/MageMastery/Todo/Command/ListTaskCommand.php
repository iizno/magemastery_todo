<?php
declare(strict_types=1);

namespace MageMastery\Todo\Command;

class ListTaskCommand extends \Symfony\Component\Console\Command\Command
{
    const NAME = "magemastery:todo:task-list";

    protected function configure()
    {
        $this->setName(self::NAME)
        ->setDescription(
            'Provide a list of tasks'
        );

        parent::configure();
    }
}

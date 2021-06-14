<?php
declare(strict_types=1);

namespace MageMastery\Todo\Ui;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Ui\Component\ColumnFactory;
use Magento\Customer\Ui\Component\Listing\AttributeRepository;
use Magento\Customer\Ui\Component\Listing\Column\InlineEditUpdater;
use Magento\Customer\Ui\Component\Listing\Columns;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class TaskCustomerColumn extends Columns
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(
        ContextInterface $context,
        ColumnFactory $columnFactory,
        AttributeRepository $attributeRepository,
        InlineEditUpdater $inlineEditor,
        CustomerRepositoryInterface  $customerRepository,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $columnFactory, $attributeRepository, $inlineEditor, $components, $data);
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param  array  $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $items[$this->getData('name')] = $this->prepareItem($item);
            }
        }

        return $dataSource;
    }

    /**
     * @param  array  $item
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function prepareItem(array $item)
    {
        try {
            $customer = $this->customerRepository->getById((int) $item['customer_id']);
        } catch (NoSuchEntityException $exception) {
            return 'N/A';
        }

        return $customer->getLastname() . ' ' . $customer->getFirstname();
    }
}

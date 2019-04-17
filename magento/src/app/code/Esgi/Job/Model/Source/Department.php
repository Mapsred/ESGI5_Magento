<?php
namespace Esgi\Job\Model\Source;

use Esgi\Job\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class Department implements OptionSourceInterface
{
    /**
     * Countries
     *
     * @var CollectionFactory $departmentCollectionFactory
     */
    protected $departmentCollectionFactory;

    /**
     * Options array
     *
     * @var array
     */
    protected $options;


    /**
     * Constructor
     *
     * @param CollectionFactory $departmentCollectionFactory
     */
    public function __construct(CollectionFactory $departmentCollectionFactory)
    {
        $this->departmentCollectionFactory = $departmentCollectionFactory;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $departmentCollection = $this->departmentCollectionFactory->create()
            ->addFieldToSelect('entity_id')
            ->addFieldToSelect('title');
        foreach ($departmentCollection as $department) {
            $options[] = [
                'label' => $department->getTitle(),
                'value' => $department->getId(),
            ];
        }
        return $options;
    }
}

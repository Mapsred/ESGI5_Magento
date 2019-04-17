<?php
namespace Esgi\Car\Model\Source;

use Esgi\Car\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class Brand implements OptionSourceInterface
{
    /**
     * Countries
     *
     * @var CollectionFactory $brandCollectionFactory
     */
    protected $brandCollectionFactory;

    /**
     * Options array
     *
     * @var array
     */
    protected $options;


    /**
     * Constructor
     *
     * @param CollectionFactory $brandCollectionFactory
     */
    public function __construct(CollectionFactory $brandCollectionFactory)
    {
        $this->brandCollectionFactory = $brandCollectionFactory;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $brandCollection = $this->brandCollectionFactory->create()
            ->addFieldToSelect('entity_id')
            ->addFieldToSelect('title');
        foreach ($brandCollection as $brand) {
            $options[] = [
                'label' => $brand->getTitle(),
                'value' => $brand->getId(),
            ];
        }
        return $options;
    }
}

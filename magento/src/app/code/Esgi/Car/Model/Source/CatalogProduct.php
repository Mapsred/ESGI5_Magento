<?php
namespace Esgi\Car\Model\Source;


use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class CatalogProduct implements OptionSourceInterface
{
    /**
     * Countries
     *
     * @var CollectionFactory $catalogProductCollectionFactory
     */
    protected $catalogProductCollectionFactory;

    /**
     * Options array
     *
     * @var array
     */
    protected $options;


    /**
     * Constructor
     *
     * @param CollectionFactory $catalogProductCollectionFactory
     */
    public function __construct(CollectionFactory $catalogProductCollectionFactory)
    {
        $this->catalogProductCollectionFactory = $catalogProductCollectionFactory;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $catalogProductCollection = $this->catalogProductCollectionFactory->create()
            ->addFieldToSelect('entity_id')
            ->addFieldToSelect('name');
        foreach ($catalogProductCollection as $catalogProduct) {
            $options[] = [
                'label' => $catalogProduct->getName(),
                'value' => $catalogProduct->getId(),
            ];
        }
        return $options;
    }
}

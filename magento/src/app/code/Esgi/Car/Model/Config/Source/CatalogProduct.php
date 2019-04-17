<?php
namespace Esgi\Car\Model\Config\Source;


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
     * @param bool $isMultiselect
     * @return array
     */
    public function toOptionArray($isMultiselect = false): array
    {
        if (!$this->options) {
            $options[] = ['label' => '', 'value' => ''];
            $catalogProductCollectionFactory = $this->catalogProductCollectionFactory->create()
                ->addFieldToSelect('entity_id')
                ->addFieldToSelect('name');
            foreach ($catalogProductCollectionFactory as $product) {
                $options[] = [
                    'label' => $product->getName(),
                    'value' => $product->getId(),
                ];
            }
            return $options;
        }

        $options = $this->options;
        if (!$isMultiselect) {
            array_unshift($options, ['value' => '', 'label' => __('--Please Select--')]);
        }

        return $options;
    }
}

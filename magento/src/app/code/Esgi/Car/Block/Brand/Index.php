<?php
namespace Esgi\Car\Block\Brand;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Esgi\Car\Model\ResourceModel\Brand\Collection;
use Esgi\Car\Model\ResourceModel\Brand\CollectionFactory;

/**
 * Brand block
 */
class Index extends Template
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory, Context $context, array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getBrands()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        return $collection->getItems();
    }


}

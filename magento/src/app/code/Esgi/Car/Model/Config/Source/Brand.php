<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Esgi\Car\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Esgi\Car\Model\ResourceModel\Brand\CollectionFactory;

/**
 * Options provider for countries list
 *
 * @api
 * @since 100.0.2
 */
class Brand implements ArrayInterface
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
     * Brand constructor
     *
     * @param CollectionFactory $brandCollectionFactory
     */
    public function __construct(CollectionFactory $brandCollectionFactory)
    {
        $this->brandCollectionFactory = $brandCollectionFactory;
    }

    /**
     * Return options array
     *
     * @param boolean $isMultiselect
     * @param string|array $foregroundCountries
     * @return array
     */
    public function toOptionArray($isMultiselect = false, $foregroundCountries = ''): array
    {
        if (!$this->options) {
            $options[] = ['label' => '', 'value' => ''];
            $brandCollectionFactory = $this->brandCollectionFactory->create()
                ->addFieldToSelect('entity_id')
                ->addFieldToSelect('title');
            foreach ($brandCollectionFactory as $brand) {
                $options[] = [
                    'label' => $brand->getTitle(),
                    'value' => $brand->getId(),
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

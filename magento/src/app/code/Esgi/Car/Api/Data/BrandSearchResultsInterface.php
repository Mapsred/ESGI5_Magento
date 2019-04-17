<?php

declare(strict_types=1);

namespace Esgi\Car\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for brand  search results.
 * @api
 */
interface BrandSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get departments list.
     *
     * @return BrandInterface[]
     */
    public function getItems();

    /**
     * Set departments list.
     *
     * @param BrandInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

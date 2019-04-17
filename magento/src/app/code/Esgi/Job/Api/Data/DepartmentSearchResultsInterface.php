<?php

declare(strict_types=1);

namespace Esgi\Job\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for job department search results.
 * @api
 */
interface DepartmentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get departments list.
     *
     * @return DepartmentInterface[]
     */
    public function getItems();

    /**
     * Set departments list.
     *
     * @param DepartmentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

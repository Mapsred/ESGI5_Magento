<?php

declare(strict_types=1);

namespace Esgi\Job\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for job job search results.
 * @api
 */
interface JobSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get jobs list.
     *
     * @return JobInterface[]
     */
    public function getItems();

    /**
     * Set jobs list.
     *
     * @param JobInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

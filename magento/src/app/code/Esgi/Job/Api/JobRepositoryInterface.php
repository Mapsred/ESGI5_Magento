<?php

declare(strict_types=1);

namespace Esgi\Job\Api;

use Esgi\Job\Api\Data\JobInterface;
use Esgi\Job\Api\Data\JobSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Esgi job CRUD interface.
 * @api
 */
interface JobRepositoryInterface
{
    /**
     * Save block.
     *
     * @param JobInterface $job
     * @return JobInterface
     * @throws LocalizedException
     */
    public function save(Data\JobInterface $job);

    /**
     * Retrieve $job.
     *
     * @param int $jobId
     * @return JobInterface
     * @throws LocalizedException
     */
    public function getById($jobId);

    /**
     * Retrieve jobs matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return JobSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete job.
     *
     * @param JobInterface $job
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(Data\JobInterface $job);

    /**
     * Delete job by ID.
     *
     * @param int $jobId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($jobId);
}

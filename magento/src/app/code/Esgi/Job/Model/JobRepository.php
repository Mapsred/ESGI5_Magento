<?php

declare(strict_types=1);

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Job\Model;

use Esgi\Job\Api\Data\JobInterface;
use Esgi\Job\Api\Data\JobInterfaceFactory;
use Esgi\Job\Api\Data\JobSearchResultsInterface;
use Esgi\Job\Api\JobRepositoryInterface;
use Esgi\Job\Api\Data;
use Esgi\Job\Model\ResourceModel\Job as JobResource;
use Esgi\Job\Model\ResourceModel\Job\Collection;
use Esgi\Job\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class JobRepository implements JobRepositoryInterface
{
    /**
     * @var JobResource
     */
    protected $resource;

    /**
     * @var JobFactory
     */
    protected $jobFactory;

    /**
     * @var JobCollectionFactory
     */
    protected $jobCollectionFactory;

    /**
     * @var JobSearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @param JobResource $resource
     * @param JobFactory $jobFactory
     * @param JobCollectionFactory $jobCollectionFactory
     * @param Data\JobSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        JobResource $resource,
        JobFactory $jobFactory,
        JobInterfaceFactory $dataJobFactory,
        JobCollectionFactory $jobCollectionFactory,
        Data\JobSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->jobFactory = $jobFactory;
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Job data
     *
     * @param JobInterface $job
     * @return Job
     * @throws CouldNotSaveException
     */
    public function save(JobInterface $job)
    {
        try {
            $this->resource->save($job);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $job;
    }

    /**
     * Load Job data by given Job Identity
     *
     * @param string $jobId
     * @return Job
     * @throws NoSuchEntityException
     */
    public function getById($jobId)
    {
        $job = $this->jobFactory->create();
        $this->resource->load($job, $jobId);
        if (!$job->getId()) {
            throw new NoSuchEntityException(__('Job with id "%1" does not exist.', $job));
        }

        return $job;
    }

    /**
     * Load Job data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param SearchCriteriaInterface $criteria
     * @return JobSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var Collection $collection */
        $collection = $this->jobCollectionFactory->create();

        /** @var JobSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete Job
     *
     * @param JobInterface $job
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(JobInterface $job)
    {
        try {
            $this->resource->delete($job);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Job by given Job Identity
     *
     * @param string $jobId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($jobId)
    {
        return $this->delete($this->getById($jobId));
    }
}

<?php

declare(strict_types=1);

namespace Esgi\Job\Api;

use Esgi\Job\Api\Data\DepartmentInterface;
use Esgi\Job\Api\Data\DepartmentSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Esgi job CRUD interface.
 * @api
 */
interface DepartmentRepositoryInterface
{
    /**
     * Save block.
     *
     * @param DepartmentInterface $department
     * @return DepartmentInterface
     * @throws LocalizedException
     */
    public function save(Data\DepartmentInterface $department);

    /**
     * Retrieve $department.
     *
     * @param int $departmentId
     * @return DepartmentInterface
     * @throws LocalizedException
     */
    public function getById($departmentId);

    /**
     * Retrieve departments matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return DepartmentSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete department.
     *
     * @param DepartmentInterface $department
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(Data\DepartmentInterface $department);

    /**
     * Delete department by ID.
     *
     * @param int $departmentId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($departmentId);
}

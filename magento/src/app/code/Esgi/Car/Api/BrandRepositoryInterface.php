<?php

declare(strict_types=1);

namespace Esgi\Car\Api;

use Esgi\Car\Api\Data\BrandInterface;
use Esgi\Car\Api\Data\BrandSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Esgi brand CRUD interface.
 * @api
 */
interface BrandRepositoryInterface
{
    /**
     * Save block.
     *
     * @param BrandInterface $brand
     * @return BrandInterface
     * @throws LocalizedException
     */
    public function save(Data\BrandInterface $brand);

    /**
     * Retrieve $brand.
     *
     * @param int $brandId
     * @return BrandInterface
     * @throws LocalizedException
     */
    public function getById($brandId);

    /**
     * Retrieve brands matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return BrandSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete brand.
     *
     * @param BrandInterface $brand
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(Data\BrandInterface $brand);

    /**
     * Delete brand by ID.
     *
     * @param int $brandId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($brandId);
}

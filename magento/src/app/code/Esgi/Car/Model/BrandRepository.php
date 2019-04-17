<?php

declare(strict_types=1);

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Esgi\Car\Model;

use Esgi\Car\Api\BrandRepositoryInterface;
use Esgi\Car\Api\Data\BrandInterface;
use Esgi\Car\Api\Data\BrandInterfaceFactory;
use Esgi\Car\Api\Data\BrandSearchResultsInterface;
use Esgi\Car\Model\ResourceModel\Brand as BrandResource;
use Esgi\Car\Model\ResourceModel\Brand\Collection;
use Esgi\Car\Model\ResourceModel\Brand\CollectionFactory as BrandCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Esgi\Car\Api\Data\BrandSearchResultsInterfaceFactory;
/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BrandRepository implements BrandRepositoryInterface
{
    /**
     * @var BrandResource
     */
    protected $resource;

    /**
     * @var BrandFactory
     */
    protected $brandFactory;

    /**
     * @var BrandCollectionFactory
     */
    protected $brandCollectionFactory;

    /**
     * @var BrandSearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @param BrandResource $resource
     * @param BrandFactory $brandFactory
     * @param BrandInterfaceFactory $dataBrandFactory
     * @param BrandCollectionFactory $brandCollectionFactory
     * @param BrandSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(BrandResource $resource, BrandFactory $brandFactory, BrandInterfaceFactory $dataBrandFactory,
                                BrandCollectionFactory $brandCollectionFactory,
                                BrandSearchResultsInterfaceFactory $searchResultsFactory)
    {
        $this->resource = $resource;
        $this->brandFactory = $brandFactory;
        $this->brandCollectionFactory = $brandCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Brand data
     *
     * @param BrandInterface $brand
     * @return Brand
     * @throws CouldNotSaveException
     */
    public function save(BrandInterface $brand)
    {
        try {
            $this->resource->save($brand);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $brand;
    }

    /**
     * Load Brand data by given Brand Identity
     *
     * @param string $brandId
     * @return Brand
     * @throws NoSuchEntityException
     */
    public function getById($brandId)
    {
        $brand = $this->brandFactory->create();
        $this->resource->load($brand, $brandId);
        if (!$brand->getId()) {
            throw new NoSuchEntityException(__('Brand with id "%1" does not exist.', $brand));
        }

        return $brand;
    }

    /**
     * Load Brand data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param SearchCriteriaInterface $criteria
     * @return BrandSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var Collection $collection */
        $collection = $this->brandCollectionFactory->create();

        /** @var BrandSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete Brand
     *
     * @param BrandInterface $brand
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(BrandInterface $brand)
    {
        try {
            $this->resource->delete($brand);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Brand by given Brand Identity
     *
     * @param string $brandId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($brandId)
    {
        return $this->delete($this->getById($brandId));
    }
}

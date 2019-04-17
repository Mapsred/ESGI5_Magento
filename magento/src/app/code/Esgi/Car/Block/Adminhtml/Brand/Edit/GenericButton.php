<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Esgi\Car\Block\Adminhtml\Brand\Edit;

use Magento\Backend\Block\Widget\Context;
use Esgi\Car\Api\BrandRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var BrandRepositoryInterface
     */
    protected $brandRepository;

    /**
     * @param Context $context
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(Context $context, BrandRepositoryInterface $brandRepository)
    {
        $this->context = $context;
        $this->brandRepository = $brandRepository;
    }

    /**
     * Return Car brand ID
     *
     * @return int|null
     */
    public function getBrandId()
    {
        try {
            return $this->brandRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

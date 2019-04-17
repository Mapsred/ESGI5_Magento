<?php

namespace Esgi\Car\Block\Brand;

use Esgi\Car\Model\Brand;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\Request\Http;
use Esgi\Car\Api\BrandRepositoryInterface;

/**
 * Brand block
 */
class Show extends Template
{
    protected $productRepository;

    protected $request;

    private $brandRepository;

    public function __construct(ProductRepositoryInterface $productRepository, BrandRepositoryInterface $brandRepository,
                                Context $context, array $data, Http $request)
    {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getBrand()
    {
        $brandId = $this->request->getParam('id');
        $brand = $this->brandRepository->getById($brandId);

        return $brand;
    }

    /**
     * @param Brand $brand
     * @return array
     * @throws NoSuchEntityException
     */
    public function getProductsByBrand($brand)
    {
        $productIds = explode(',', $brand->getProducts());
        $products = [];
        foreach ($productIds as $productId) {
            $products[] = $this->productRepository->getById($productId);
        }

        return $products;
    }


}

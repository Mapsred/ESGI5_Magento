<?php

declare(strict_types=1);

namespace Esgi\Car\Model;

use Esgi\Car\Api\Data\BrandInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Esgi\Car\Model\ResourceModel\Brand as BrandResourceModel;

class Brand extends AbstractModel implements BrandInterface, IdentityInterface
{
    /**
     * Esgi Car brand cache tag
     */
    const CACHE_TAG = 'esgi_car_d';

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'esgi_car';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'brand';

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BrandResourceModel::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve brand id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Retrieve brand name
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve brand content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }


    /**
     * Retrieve brand content
     *
     * @return string
     */
    public function getProducts()
    {
        return $this->getData(self::PRODUCTS);
    }



    /**
     * Set ID
     *
     * @param int $id
     * @return BrandInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $title
     * @return BrandInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BrandInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set content
     *
     * @param string $products
     * @return BrandInterface
     */
    public function setProducts($products)
    {
        return $this->setData(self::PRODUCTS, $products);
    }
}

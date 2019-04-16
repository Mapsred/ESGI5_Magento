<?php

declare(strict_types=1);

namespace Esgi\Job\Model;

use Esgi\Job\Api\Data\DepartmentInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\{};
use Magento\Framework\DataObject\IdentityInterface;
use Esgi\Job\Model\ResourceModel\Department as DepartmentResourceModel;

/**
 * Class Department
 * @author François MATHIEU <francois.mathieu@livexp.fr>
 * @method setUpdateTime($_)
 */
class Department extends AbstractModel implements DepartmentInterface, IdentityInterface
{
    /**
     * Esgi Job department cache tag
     */
    const CACHE_TAG = 'esgi_job_d';

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'esgi_job';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'department';

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
        $this->_init(DepartmentResourceModel::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve department id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Retrieve department name
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve department content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return DepartmentInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $title
     * @return DepartmentInterface
     */
    public function setTitle(string $title): DepartmentInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return DepartmentInterface
     */
    public function setContent(string $content): DepartmentInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Description beforeSave function
     *
     * @return AbstractModel
     */
    public function beforeSave(): AbstractModel
    {
        if ($this->hasDataChanges()) {
            $this->setUpdateTime(null);
        }

        return parent::beforeSave();
    }
}

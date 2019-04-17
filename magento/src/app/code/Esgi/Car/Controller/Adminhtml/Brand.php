<?php

namespace Esgi\Car\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Registry;

abstract class Brand extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Esgi_Car::brand';
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(Context $context, Registry $coreRegistry)
    {
        parent::__construct($context);

        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     *
     * @return Page
     */
    protected function initPage($resultPage)
    {
        $resultPage
            ->setActiveMenu('Esgi_Car::brand')
            ->addBreadcrumb(__('Brand'), __('Brand'))
            ->addBreadcrumb(__('Brands'), __('Brands'));

        return $resultPage;
    }
}

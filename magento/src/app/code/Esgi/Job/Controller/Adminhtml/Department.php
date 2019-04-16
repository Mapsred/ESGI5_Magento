<?php

namespace Esgi\Job\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Registry;

abstract class Department extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Esgi_Job::department';

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
            ->setActiveMenu('Esgi_Job::department')
            ->addBreadcrumb(__('Job'), __('Department'))
            ->addBreadcrumb(__('Departments'), __('Departments'));

        return $resultPage;
    }
}

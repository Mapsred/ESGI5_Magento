<?php

namespace Esgi\Car\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;


class Index extends Action
{
    const ADMIN_RESOURCE = 'Esgi_Job::brand';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Esgi_Car::brand');
        $resultPage->addBreadcrumb(__('Brands'), __('Brands'));
        $resultPage->addBreadcrumb(__('Manage Brands'), __('Manage Brands'));
        $resultPage->getConfig()->getTitle()->prepend(__('Brand'));

        return $resultPage;
    }
}

<?php

namespace Esgi\Car\Controller\Adminhtml\Brand;

use Esgi\Car\Model\Brand;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Esgi\Car\Controller\Adminhtml\Brand
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, Registry $coreRegistry, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit Job department
     *
     * @return ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(Brand::class);
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This department no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('car_brand', $model);

        // 5. Build edit form
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Brand') : __('New Brand'),
            $id ? __('Edit Brand') : __('New Brand')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Brands'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Brand'));

        return $resultPage;
    }
}

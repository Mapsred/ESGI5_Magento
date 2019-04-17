<?php

namespace Esgi\Car\Controller\Adminhtml\Brand;

use Esgi\Car\Controller\Adminhtml\Brand as AdminHTMLBrand;
use Esgi\Car\Model\Brand;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

class Delete extends AdminHTMLBrand
{
    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(Brand::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the department.'));

                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a department to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}

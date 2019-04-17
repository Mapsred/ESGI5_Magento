<?php

namespace Esgi\Car\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action\Context;
use Esgi\Car\Model\Brand;
use Esgi\Car\Model\BrandFactory;
use Esgi\Car\Model\ResourceModel\Brand as BrandResourceModel;
use Esgi\Car\Api\BrandRepositoryInterface;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class Save extends \Esgi\Car\Controller\Adminhtml\Brand
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * Description $brandRepository field
     *
     * @var BrandRepositoryInterface $brandRepository
     */
    protected $brandRepository;
    /**
     * Description $brandFactory field
     *
     * @var BrandFactory $brandFactory
     */
    protected $brandFactory;
    /**
     * Description $brandResourceModel field
     *
     * @var BrandResourceModel $brandResourceModel
     */
    protected $brandResourceModel;

    /**
     * Save constructor
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     * @param BrandRepositoryInterface $brandRepository
     * @param BrandFactory $brandFactory
     * @param BrandResourceModel $brandResourceModel
     */
    public function __construct(Context $context, Registry $coreRegistry, DataPersistorInterface $dataPersistor,
                                BrandRepositoryInterface $brandRepository, BrandFactory $brandFactory,
                                BrandResourceModel $brandResourceModel)
    {
        parent::__construct($context, $coreRegistry);

        $this->dataPersistor = $dataPersistor;
        $this->brandRepository = $brandRepository;
        $this->brandFactory = $brandFactory;
        $this->brandResourceModel = $brandResourceModel;
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            /** @var Brand $model */
            $model = $this->brandFactory->create();

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                try {
                    $model = $this->brandRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This brand no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            if ($data['products']) {
                $productsId = implode(',', $data['products']);
                $model->setProducts($productsId);

            }

            try {
                $this->brandRepository->save($model);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the brand.'));
            }

            $this->dataPersistor->set('car_brand', $data);

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }

}

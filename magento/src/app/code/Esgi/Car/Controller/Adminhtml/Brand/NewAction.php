<?php

namespace Esgi\Car\Controller\Adminhtml\Brand;

use Esgi\Car\Controller\Adminhtml\Brand;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Forward;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Registry;

class NewAction extends Brand
{
    /**
     * @var Forward
     */
    protected $resultForwardFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(Context $context, Registry $coreRegistry, ForwardFactory $resultForwardFactory)
    {
        parent::__construct($context, $coreRegistry);

        $this->resultForwardFactory = $resultForwardFactory;
    }

    /**
     * Forward to edit
     *
     * @return Forward
     */
    public function execute()
    {
        /** @var Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}

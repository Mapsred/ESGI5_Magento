<?php

namespace BonusFixedFees\FixedFees\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Add Weee item to Payment Cart amount.
 */
class AddCustomAmountItem implements ObserverInterface
{
    /**
     * Add custom amount as custom item to payment cart totals.
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Payment\Model\Cart $cart */
        $cart = $observer->getEvent()->getCart();
        $customAmount = 10;
        $cart->addCustomItem(__('FixedFees'),1, $customAmount,'fixedfees');
    }



}
<?php

namespace Esgi\BonusFixedFees\Model\Quote\Address\Total;

use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;

class FixedFees extends AbstractTotal
{
    /**
     * @var PriceCurrencyInterface
     */
    protected $_priceCurrency;

    /**
     * @param PriceCurrencyInterface $priceCurrency
     */
    public function __construct(PriceCurrencyInterface $priceCurrency)
    {
        $this->_priceCurrency = $priceCurrency;
    }

    public function collect(Quote $quote, ShippingAssignmentInterface $shippingAssignment, Total $total)
    {
        parent::collect($quote, $shippingAssignment, $total);
        $fixedFees = 10;
        $total->addTotalAmount('fixedfees', $fixedFees);
        $quote->setFixedFees($fixedFees);

        return $this;
    }

    public function fetch(Quote $quote, Total $total)
    {
        return [
            'code' => 'Fixed_Fees',
            'title' => $this->getLabel(),
            'value' => 10
        ];
    }

    /**
     * get label
     * @return string
     */
    public function getLabel()
    {
        return __('Fixed Fees');
    }
}

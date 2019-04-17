<?php
namespace BonusFixedFees\Model\Quote\Address\Total;
class FixedFees extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $_priceCurrency;
  
    /**
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    ) {
        $this->_priceCurrency = $priceCurrency;
    }
  
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        $fixedFees = 10;
        $total->addTotalAmount('fixedfees', $fixedFees);
        $total->addBaseTotalAmount('fixedfees', $fixedFees);
        $quote->setFixedFees($fixedFees);
        return $this;
    }
  
    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
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
    public function getLabel() {
        return __('Fixed Fees');
    }
}
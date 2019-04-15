<?php

namespace Esgi\Helloworld\Block;

use Magento\Framework\View\Element\Template;

/**
 * Hello block
 */
class Hello extends Template
{
    /**
     * @param $name
     * @return string
     */
    public function hello($name)
    {
        return 'Hello ' . $name;
    }
}

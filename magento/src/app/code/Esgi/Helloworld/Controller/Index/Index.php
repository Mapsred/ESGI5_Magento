<?php

namespace Esgi\Helloworld\Controller\Index;

use Magento\Framework\App\Action\Action;

class Index extends Action
{
    public function execute()
    {
        echo 'Execute Action Index_Index OK';
        die();
    }
}

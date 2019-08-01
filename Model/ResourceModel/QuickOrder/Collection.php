<?php

namespace Roma\QuickOrder\Model\ResourceModel\QuickOrder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Roma\QuickOrder\Model\ResourceModel\QuickOrder as Model;
use Roma\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Roma\QuickOrder\Model\QuickOrder::class, \Roma\QuickOrder\Model\ResourceModel\QuickOrder::class);
    }
}
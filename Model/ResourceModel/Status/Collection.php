<?php

namespace Roma\QuickOrder\Model\ResourceModel\Status;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Roma\QuickOrder\Model\ResourceModel\Status as Model;
use Roma\QuickOrder\Model\ResourceModel\Status as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
<?php

namespace Roma\QuickOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Roma\QuickOrder\Api\Data\QuickOrderInterface;

class QuickOrder extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Roma\QuickOrder\Api\Data\QuickOrderInterface::TABLE_NAME, \Roma\QuickOrder\Api\Data\QuickOrderInterface::ID_FIELD);
    }
}
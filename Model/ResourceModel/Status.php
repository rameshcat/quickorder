<?php

namespace Roma\QuickOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Roma\QuickOrder\Api\Data\StatusInterface;

class Status extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Roma\QuickOrder\Api\Data\StatusInterface::TABLE_NAME, \Roma\QuickOrder\Api\Data\StatusInterface::ID_FIELD);
    }
}
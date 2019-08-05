<?php

namespace Roma\QuickOrder\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

use Roma\QuickOrder\Api\Data\StatusInterface;
use Roma\QuickOrder\Model\ResourceModel\Status as ResourceModel;

class Status extends AbstractModel implements StatusInterface, IdentityInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", \Roma\QuickOrder\Api\Data\StatusInterface::CACHE_TAG, $this->getId())];
    }

    /** {@inheritdoc} */
    public function getStatusName()
    {
        return $this->getData(\Roma\QuickOrder\Api\Data\StatusInterface::STATUS_NAME_FIELD);
    }

    /** {@inheritdoc} */
    public function setStatusName($statusName)
    {
        $this->setData(\Roma\QuickOrder\Api\Data\StatusInterface::STATUS_NAME_FIELD, $statusName);
        return $this;
    }

    /** {@inheritdoc} */
    public function getByDefault()
    {
        return $this->getData(\Roma\QuickOrder\Api\Data\StatusInterface::BY_DEFAULT_FIELD);
    }

    /** {@inheritdoc} */
    public function setByDefault($byDefault)
    {
        $this->setData(\Roma\QuickOrder\Api\Data\StatusInterface::BY_DEFAULT_FIELD, $byDefault);
        return $this;
    }
}
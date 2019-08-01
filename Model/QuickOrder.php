<?php

namespace Roma\QuickOrder\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Stdlib\DateTime;

use Roma\QuickOrder\Api\Data\QuickOrderInterface;
use Roma\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;

class QuickOrder extends AbstractModel implements QuickOrderInterface, IdentityInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }
    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", \Roma\QuickOrder\Api\Data\QuickOrderInterface::CACHE_TAG, $this->getId())];
    }
    /** {@inheritdoc} */
    public function getName()
    {
        return $this->getData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::NAME_FIELD);
    }
    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::NAME_FIELD, $name);
        return $this;
    }
    /** {@inheritdoc} */
    public function getPhone()
    {
        return $this->getData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::PHONE_FIELD);
    }
    /** {@inheritdoc} */
    public function setPhone($phone)
    {
        $this->setData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::PHONE_FIELD, $phone);
        return $this;
    }
    /** {@inheritdoc} */
    public function getEmail()
    {
        return $this->getData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::EMAIL_FIELD);
    }
    /** {@inheritdoc} */
    public function setEmail($email)
    {
        return $this->setData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::EMAIL_FIELD, $email);
    }
    /** {@inheritdoc} */
    public function getSku()
    {
        return $this->getData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::SKU_FIELD);
    }
    /** {@inheritdoc} */
    public function setSku($sku)
    {
        return $this->setData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::EMAIL_FIELD, $sku);
    }
    /** {@inheritdoc} */
    public function getStatus()
    {
        return $this->getData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::STATUS_FIELD);
    }
    /** {@inheritdoc} */
    public function setStatus($email)
    {
        return $this->setData(\Roma\QuickOrder\Api\Data\QuickOrderInterface::STATUS_FIELD, $email);
    }
}

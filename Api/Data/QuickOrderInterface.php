<?php

namespace Roma\QuickOrder\Api\Data;

interface QuickOrderInterface
{
    const TABLE_NAME                = 'quick_order';
    const ID_FIELD                  = 'quick_order_id';
    const NAME_FIELD                = 'name';
    const PHONE_FIELD               = 'phone';
    const EMAIL_FIELD               = 'email';
    const SKU_FIELD                 = 'sku';
    const STATUS_FIELD              = 'status';
    const CREATE_AT_FIELD           = 'create_at';
    const UPDATE_AT_FIELD           = 'update_at';
    const CACHE_TAG                 = 'roma_quickorder';
    const REGISTRY_KEY              = 'quickorder_quickorder';
    /**
     * @return mixed
     */
    public function getId();
    /**
     * @return mixed
     */
    public function getName();
    /**
     * @param string $firstName
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     */
    public function setName($name);
    /**
     * @return mixed
     */
    public function getPhone();
    /**
     * @param string $lastName
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     */
    public function setPhone($phone);
    /**
     * @return mixed
     */
    public function getEmail();
    /**
     * @param string $code
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     */
    public function setEmail($email);
    /**
     * @return mixed
     */
    public function getSku();
    /**
     * @param string $code
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     */
    public function setSku($sku);
    /**
     * @return mixed
     */
    public function getStatus();
    /**
     * @param string $code
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     */
    public function setStatus($status);
    /**
     * @return mixed
     */
    public function getDateTime();
    /**
     * @param string $createAt
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     */
    public function setDateTime($createAt);
    /**
     * @return mixed
     */
    public function getUpdateDateTime();
    /**
     * @param string $updatedAt
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     */
    public function setUpdateDateTime($updatedAt);

}


<?php

namespace Roma\QuickOrder\Api\Data;

interface StatusInterface
{
    const TABLE_NAME = 'status';
    const ID_FIELD = 'status_id';
    const STATUS_NAME_FIELD = 'status_name';
    const CACHE_TAG = 'roma_quickorder';
    const REGISTRY_KEY = 'quickorder_quickorder';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getStatusName();

    /**
     * @param string $statusName
     * @return \Roma\QuickOrder\Api\Data\StatusInterface
     */
    public function setStatusName($statusName);

}
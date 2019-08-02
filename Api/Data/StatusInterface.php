<?php

namespace Roma\QuickOrder\Api\Data;

interface StatusInterface
{
    const TABLE_NAME = 'status';
    const ID_FIELD = 'status_id';
    const STATUS_NAME_FIELD = 'status_name';
    const BY_DEFAULT_FIELD = 'by_default';
    const CACHE_TAG = 'roma_quickorder';
    const REGISTRY_KEY = 'quickorder_quickorder';

    /**
     * @return mixed
     */
    public function getStatusId();

    /**
     * @return mixed
     */
    public function getStatusName();

    /**
     * @param string $statusName
     * @return \Roma\QuickOrder\Api\Data\StatusInterface
     */
    public function setStatusName($statusName);

    /**
     * @return bool
     */
    public function getByDefault();

    /**
     * @param bool $byDefault
     * @return \Roma\QuickOrder\Api\Data\StatusInterface
     */
    public function setByDefault($byDefault);
}
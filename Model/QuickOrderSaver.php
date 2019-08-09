<?php

namespace Roma\QuickOrder\Model;

use Roma\QuickOrder\Api\QuickOrderRepositoryInterface;

class QuickOrderSaver
{
    protected $model;
    protected $date;
    protected $scopeConfig;
    protected $repository;

    public function __construct(
        \Roma\QuickOrder\Model\QuickOrder $model,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        QuickOrderRepositoryInterface $repository
    ) {
        $this->model = $model;
        $this->date = $date;
        $this->scopeConfig = $scopeConfig;
        $this->repository = $repository;
    }

    public function save(array $data): void
    {
        //throw new \Exception('Something went wrong, please try again!');
        $defaultStatus = $this->scopeConfig->getValue('quickorder/general/by_default', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $this->model->setData($data);
        $this->model->setStatus($defaultStatus);
        $this->model->setDateTime($this->date->gmtDate());
        $this->model->setUpdateDateTime($this->date->gmtDate());
        $this->repository->save($this->model);
    }
}
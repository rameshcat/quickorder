<?php


namespace Roma\QuickOrder\Model;


use mysql_xdevapi\Exception;

class QuickOrderSaver
{
    protected $model;
    protected $date;
    protected $scopeConfig;

    public function __construct(
        \Roma\QuickOrder\Model\QuickOrder $model,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->model = $model;
        $this->date = $date;
        $this->scopeConfig = $scopeConfig;
    }

    public function save(array $data): void
    {
        //throw new \Exception('asdfasdf');
        $defaultStatus = $this->scopeConfig->getValue('quickorder/general/by_default', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $this->model->setData($data);
        $this->model->setStatus($defaultStatus);
        $this->model->setDateTime($this->date->gmtDate());
        $this->model->setUpdateDateTime($this->date->gmtDate());
        $this->model->save();
    }
}
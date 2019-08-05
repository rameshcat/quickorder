<?php

namespace Roma\QuickOrder\Controller\Index;

use Magento\Framework\App\Action\Action as BaseAction;
use Magento\Framework\Controller\ResultFactory;


class Index extends BaseAction
{
    protected $model;
    protected $date;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Roma\QuickOrder\Model\QuickOrder $model,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->model = $model;
        $this->date = $date;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $defaultStatus = $this->scopeConfig->getValue('quickorder/general/by_default', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $data = $this->getRequest()->getParams();
        $this->model->setData($data);
        $this->model->setStatus($defaultStatus);
        $this->model->setDateTime($this->date->gmtDate());
        $this->model->setUpdateDateTime($this->date->gmtDate());

        $this->model->save();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        return $resultRedirect;
    }
}
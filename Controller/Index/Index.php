<?php

namespace Roma\QuickOrder\Controller\Index;

use Magento\Framework\App\Action\Action as BaseAction;
use Magento\Framework\Controller\ResultFactory;


class Index extends BaseAction
{
    protected $model;
    protected $date;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Roma\QuickOrder\Model\QuickOrder $model,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->model = $model;
        $this->date = $date;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getParams();
        //var_dump($data);die;
        $this->model->setData($data);
        $this->model->setStatus('default');
        $this->model->setDateTime($this->date->gmtDate());
        $this->model->setUpdateDateTime($this->date->gmtDate());

        $this->model->save();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
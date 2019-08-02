<?php

namespace Roma\QuickOrder\Controller\Index;

use Magento\Framework\App\Action\Action as BaseAction;
use Magento\Framework\Controller\ResultFactory;

class Index extends BaseAction
{
    protected $model;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Roma\QuickOrder\Model\QuickOrder $model
    ) {
        $this->model = $model;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        $this->model->setData($data);
        $this->model->save();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
<?php

namespace Roma\QuickOrder\Controller\Index;

use Magento\Framework\App\Action\Action as BaseAction;
use Magento\Framework\Controller\ResultFactory;

class Index extends BaseAction
{
    protected $question;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Roma\QuickOrder\Model\QuickOrder $question
    ) {
        $this->question = $question;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        //$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        //$question = $objectManager->create('Roma\QuickOrder\Model\QuickOrder');
        $this->question->setData($data);
        $this->question->save();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
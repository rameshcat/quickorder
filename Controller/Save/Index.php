<?php

namespace Roma\QuickOrder\Controller\Save;

use Magento\Framework\App\Action\Action as BaseAction;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use mysql_xdevapi\Exception;


class Index extends BaseAction
{
    protected $saver;
    protected $jsonFactory;
    protected $messageManager;

    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Roma\QuickOrder\Model\QuickOrderSaver $saver
    )
    {
        $this->messageManager = $messageManager;
        $this->saver = $saver;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $result = $this->jsonFactory->create();

        try {
            $this->saver->save($data);
        } catch (\Throwable $th) {
            return $result->setStatusHeader(500)->setData(['message' => $th->getMessage()]);
        };
        $this->messageManager->addSuccess(__("Your order successfully added"));
        return $result->setData(['message' => 'success']);
    }
}
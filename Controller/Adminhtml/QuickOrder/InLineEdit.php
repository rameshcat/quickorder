<?php

namespace Roma\QuickOrder\Controller\Adminhtml\QuickOrder;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $jsonFactory;
    protected $date;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->date = $date;
    }
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    /** load your model to update the data */
                    $model = $this->_objectManager->create('Roma\QuickOrder\Model\QuickOrder')->load($entityId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$entityId]));
                        $model->setUpdateDateTime($this->date->gmtDate());
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}

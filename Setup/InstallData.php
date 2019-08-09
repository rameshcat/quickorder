<?php

namespace Roma\QuickOrder\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use Roma\QuickOrder\Api\Data\StatusInterface;
use Roma\QuickOrder\Api\Data\StatusInterfaceFactory;

class InstallData implements InstallDataInterface
{
    /** @var StatusInterfaceFactory */
    private $statusInterfaceFactory;
    /** @var TransactionFactory */
    private $transactionFactory;
    /** LoggerInterface */
    private $logger;

    public function __construct(
        StatusInterfaceFactory $statusInterfaceFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    )
    {
        $this->statusInterfaceFactory = $statusInterfaceFactory;
        $this->transactionFactory = $transactionFactory;
        $this->logger = $logger;
    }

    /** {@inheritdoc} */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var Transaction $transactionalModel */
        $transactionalModel = $this->transactionFactory->create();

        $statuses = [
            'Pending',
            'Approved',
            'Decline'
        ];
        /** @var StatusInterface $status */
        foreach ($statuses as $value) {
            $status = $this->statusInterfaceFactory->create();
            $status->setStatusName("$value");
            $transactionalModel->addObject($status);
        }
        try {
            $transactionalModel->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
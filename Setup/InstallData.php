<?php


namespace Roma\QuickOrder\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use Roma\QuickOrder\Model\Status;
use Roma\QuickOrder\Model\StatusFactory;

class InstallData implements InstallDataInterface
{
    /** @var StatusFactory  */
    private $statusFactory;
    /** @var TransactionFactory */
    private $transactionFactory;
    /** LoggerInterface */
    private $logger;
    public function __construct(
        StatusFactory $statusFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    ) {
        $this->statusFactory        = $statusFactory;
        $this->transactionFactory   = $transactionFactory;
        $this->logger               = $logger;
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
        /** @var Status $status */
        foreach ($statuses as $value) {
            $status = $this->statusFactory->create();
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
<?php

namespace Roma\QuickOrder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Roma\QuickOrder\Api\Data\QuickOrderInterface;
use Roma\QuickOrder\Api\Data\StatusInterface;

class InstallSchema implements InstallSchemaInterface
{
    /** {@inheritdoc} */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        /** create table `quick_order` */
        $table = $installer->getConnection()->newTable(
            $installer->getTable(QuickOrderInterface::TABLE_NAME)
        )->addColumn(
            QuickOrderInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'QuickOrder ID'
        )->addColumn(
            QuickOrderInterface::NAME_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
        )->addColumn(
            QuickOrderInterface::PHONE_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Phone'
        )->addColumn(
            QuickOrderInterface::EMAIL_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'E-mail'
        )->addColumn(
            QuickOrderInterface::SKU_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Product SKU'
        )->addColumn(
            QuickOrderInterface::STATUS_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Status'
        )->addColumn(
            QuickOrderInterface::CREATE_AT_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Create At'
        )->addColumn(
            QuickOrderInterface::UPDATE_AT_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Update At'
        )->setComment(
            'QuickOrder Table'
        );
        $installer->getConnection()->createTable($table);

        $table = $installer->getConnection()->newTable(
            $installer->getTable(StatusInterface::TABLE_NAME)
        )->addColumn(
            StatusInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Status ID'
        )->addColumn(
            StatusInterface::STATUS_NAME_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Status Name'
        )->addColumn(
            StatusInterface::BY_DEFAULT_FIELD,
            Table::TYPE_BOOLEAN,
            255,
            ['nullable' => false],
            'By Default'
        )->setComment(
            'Status Table'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}

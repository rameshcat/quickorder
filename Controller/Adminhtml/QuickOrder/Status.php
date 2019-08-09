<?php

namespace Roma\QuickOrder\Controller\Adminhtml\QuickOrder;

use Roma\QuickOrder\Controller\Adminhtml\Status as BaseAction;

class Status extends BaseAction
{
    const ACL_RESOURCE      = 'Roma_QuickOrder::status';
    const MENU_ITEM         = 'Roma_QuickOrder::status';
    const PAGE_TITLE        = 'Add New Status';
    const BREADCRUMB_TITLE  = 'Add New Status';
}
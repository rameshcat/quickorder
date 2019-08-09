<?php

namespace Roma\QuickOrder\Controller\Adminhtml;

use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

use Roma\QuickOrder\Api\Data\StatusInterface;
use Roma\QuickOrder\Api\StatusRepositoryInterface;
use Roma\QuickOrder\Model\StatusFactory;

abstract class Status extends Action
{
    const ACL_RESOURCE          = 'QuickOrder::status';
    const MENU_ITEM             = 'QuickOrder::status';
    const PAGE_TITLE            = 'QuickOrder';
    const BREADCRUMB_TITLE      = 'QuickOrder';
    const QUERY_PARAM_ID        = 'id';
    /** @var Registry  */
    protected $registry;
    /** @var PageFactory  */
    protected $pageFactory;
    /** @var  StatusFactory */
    protected $modelFactory;
    /** @var StatusInterface */
    protected $model;
    /** @var Page */
    protected $resultPage;
    /** @var StatusInterface */
    protected $repository;
    /** @var Logger */
    protected $logger;
    /**
     * @param Context                       $context
     * @param Registry                      $registry
     * @param PageFactory                   $pageFactory
     * @param StatusRepositoryInterface     $repository
     * @param StatusFactory                 $factory
     * @param LoggerInterface               $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        StatusRepositoryInterface $repository,
        StatusFactory $factory,
        LoggerInterface $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $repository;
        $this->modelFactory   = $factory;
        $this->logger         = $logger;
        parent::__construct($context);
    }
    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();
        return $this->resultPage;
    }
    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);
        return $result;
    }
    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }
        return $this->resultPage;
    }
    /**
     * @return QuickOrder
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        return $this;
    }
    /** @return StatusInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }
        return $this->model;
    }
    /**
     * @return ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());
        return $redirect;
    }
    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/status/listing');
    }
}
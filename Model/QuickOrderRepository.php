<?php

namespace Roma\QuickOrder\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use Roma\QuickOrder\Api\Data\QuickOrderInterface;
use Roma\QuickOrder\Api\QuickOrderRepositoryInterface;
use Roma\QuickOrder\Api\Data\QuickOrderSearchResultsInterfaceFactory;
use Roma\QuickOrder\Model\ResourceModel\QuickOrder as ResourceModel;
use Roma\QuickOrder\Model\QuickOrderFactory;
use Roma\QuickOrder\Model\ResourceModel\QuickOrder\CollectionFactory;

class QuickOrderRepository implements QuickOrderRepositoryInterface
{
    /** @var ResourceModel */
    protected $resource;
    /** @var QuickOrderFactory  */
    protected $quickOrderFactory;
    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;
    /** @var CollectionFactory */
    protected $collectionFactory;
    /** @var QuickOrderSearchResultsInterfaceFactory */
    protected $searchResultsFactory;
    public function __construct(
        \Roma\QuickOrder\Model\ResourceModel\QuickOrder $resource,
        \Roma\QuickOrder\Model\QuickOrderFactory $quickOrderFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Roma\QuickOrder\Model\ResourceModel\QuickOrder\CollectionFactory $collectionFactory,
        \Roma\QuickOrder\Api\Data\QuickOrderSearchResultsInterfaceFactory $quickOrderSearchResultsFactory
    ) {
        $this->resource                 = $resource;
        $this->quickOrderFactory        = $quickOrderFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $quickOrderSearchResultsFactory;
    }
    /** {@inheritdoc} */
    public function getById($id)
    {
        $quickOrder = $this->quickOrderFactory->create();
        $this->resource->load($quickOrder, $id);
        if (!$quickOrder->getId()) {
            throw new NoSuchEntityException(__('Order with id "%1" does not exist.', $id));
        }
        return $quickOrder;
    }
    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }
    /** {@inheritdoc} */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
    /** {@inheritdoc} */
    public function save(\Roma\QuickOrder\Api\Data\QuickOrderInterface $quickOrder)
    {
        try {
            $this->resource->save($quickOrder);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $quickOrder;
    }
    /** {@inheritdoc} */
    public function delete(\Roma\QuickOrder\Api\Data\QuickOrderInterface $quickOrder)
    {
        try {
            $this->resource->delete($quickOrder);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;
    }
}
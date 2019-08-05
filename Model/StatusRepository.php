<?php

namespace Roma\QuickOrder\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use Roma\QuickOrder\Api\Data\StatusInterface;
use Roma\QuickOrder\Api\StatusRepositoryInterface;
use Roma\QuickOrder\Api\Data\StatusSearchResultsInterfaceFactory;
use Roma\QuickOrder\Model\ResourceModel\Status as ResourceModel;
use Roma\QuickOrder\Model\StatusFactory;
use Roma\QuickOrder\Model\ResourceModel\Status\CollectionFactory;

class StatusRepository implements StatusRepositoryInterface
{
    /** @var ResourceModel */
    protected $resource;
    /** @var StatusFactory  */
    protected $quickOrderFactory;
    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;
    /** @var CollectionFactory */
    protected $collectionFactory;
    /** @var StatusSearchResultsInterfaceFactory */
    protected $searchResultsFactory;
    public function __construct(
        \Roma\QuickOrder\Model\ResourceModel\Status $resource,
        \Roma\QuickOrder\Model\StatusFactory $statusFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Roma\QuickOrder\Model\ResourceModel\Status\CollectionFactory $collectionFactory,
        \Roma\QuickOrder\Api\Data\StatusSearchResultsInterfaceFactory $statusSearchResultsFactory
    ) {
        $this->resource                 = $resource;
        $this->statusFactory        = $statusFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $statusSearchResultsFactory;
    }
    /** {@inheritdoc} */
    public function getById($id)
    {
        $status = $this->statusFactory->create();
        $this->resource->load($status, $id);
        if (!$status->getId()) {
            throw new NoSuchEntityException(__('Order with id "%1" does not exist.', $id));
        }
        return $status;
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
    public function save(\Roma\QuickOrder\Api\Data\StatusInterface $status)
    {
        try {
            $this->resource->save($status);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $status;
    }
    /** {@inheritdoc} */
    public function delete(\Roma\QuickOrder\Api\Data\StatusInterface $status)
    {
        try {
            $this->resource->delete($status);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;
    }
}
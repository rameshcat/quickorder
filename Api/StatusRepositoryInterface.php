<?php

namespace Roma\QuickOrder\Api;

interface StatusRepositoryInterface
{
    /**
     * @param int $id
     * @return \Roma\QuickOrder\Api\Data\StatusInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
    /**
     * @param int $id
     * @return \Roma\QuickOrder\Api\StatusRepositoryInterface
     */
    public function deleteById($id);
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria | null
     * @return \Roma\QuickOrder\Api\Data\StatusSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
    /**
     * @param \Roma\QuickOrder\Api\Data\StatusInterface $status
     * @return \Roma\QuickOrder\Api\Data\StatusInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Roma\QuickOrder\Api\Data\StatusInterface $status);
    /**
     * @param \Roma\QuickOrder\Api\Data\StatusInterface $status
     * @return \Roma\QuickOrder\Api\QuickOrderRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Roma\QuickOrder\Api\Data\StatusInterface $status);
}
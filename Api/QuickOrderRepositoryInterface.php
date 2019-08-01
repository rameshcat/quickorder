<?php

namespace Roma\QuickOrder\Api;

interface QuickOrderRepositoryInterface
{
    /**
     * @param int $id
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
    /**
     * @param int $id
     * @return \Roma\QuickOrder\Api\QuickOrderRepositoryInterface
     */
    public function deleteById($id);
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria | null
     * @return \Roma\QuickOrder\Api\Data\QuickOrderSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
    /**
     * @param \Roma\QuickOrder\Api\Data\QuickOrderInterface $quickorder
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Roma\QuickOrder\Api\Data\QuickOrderInterface $quickorder);
    /**
     * @param \Roma\QuickOrder\Api\Data\QuickOrderInterface $quickorder
     * @return \Roma\QuickOrder\Api\QuickOrderRepositoryInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Roma\QuickOrder\Api\Data\QuickOrderInterface $quickorder);
}
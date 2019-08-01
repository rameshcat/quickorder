<?php

namespace Roma\QuickOrder\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface QuickOrderSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get QuickOrder list.
     *
     * @return \Roma\QuickOrder\Api\Data\QuickOrderInterface[]
     */
    public function getItems();
    /**
     * Set blocks list.
     *
     * @param QuickOrderInterface[] $items
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function setItems(array $items);
}
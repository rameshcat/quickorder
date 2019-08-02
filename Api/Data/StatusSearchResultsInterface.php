<?php

namespace Roma\QuickOrder\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface StatusSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Status list.
     *
     * @return \Roma\QuickOrder\Api\Data\StatusInterface[]
     */
    public function getItems();
    /**
     * Set blocks list.
     *
     * @param StatusInterface[] $items
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function setItems(array $items);
}
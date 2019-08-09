<?php


namespace Roma\QuickOrder\UI\Component\Listing\Status;

use Roma\QuickOrder\Model\ResourceModel\Status\Grid\CollectionFactory;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->collectionFactory->create();
        $items = $collection->getData();
        foreach ($items as $item){
            $optionArray[] =  ['value' => $item['status_id'],'label' => $item['status_name']];
        }

        return $optionArray;
    }
}
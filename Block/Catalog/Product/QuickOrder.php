<?php

namespace Roma\QuickOrder\Block\Catalog\Product;
 
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\AbstractProduct;
 
class QuickOrder extends AbstractProduct
{
    protected $registry;

    public function __construct(
        \Magento\Framework\Registry $registry,
        Context $context,
        array $data
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }
}
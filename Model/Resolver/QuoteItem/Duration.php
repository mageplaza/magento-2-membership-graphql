<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_MembershipGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */
declare(strict_types=1);

namespace Mageplaza\MembershipGraphQl\Model\Resolver\QuoteItem;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Quote\Model\Quote\Item as QuoteItem;
use Mageplaza\Membership\Helper\Data;
use Mageplaza\Membership\Model\Config\Source\FieldRenderer;

/**
 * Class Duration
 * @package Mageplaza\MembershipGraphQl\Model\Resolver\QuoteItem
 */
class Duration implements ResolverInterface
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * Duration constructor.
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->helperData = $helper;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        /** @var QuoteItem $quoteItem */
        $quoteItem = $value['model'];
        $option    = $quoteItem->getOptionByCode(FieldRenderer::DURATION);
        if ($option && $option->getValue()) {
            return $this->helperData->getDurationText($option->getValue());
        }

        return '';
    }
}

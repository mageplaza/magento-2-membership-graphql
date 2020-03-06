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

namespace Mageplaza\MembershipGraphQl\Model\Resolver\Product;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Mageplaza\Membership\Helper\Data;
use Mageplaza\Membership\Model\Config\Source\FieldRenderer;

/**
 * Class ProductAttribute
 * @package Mageplaza\MembershipGraphQl\Model\Resolver\Product
 */
class ProductAttribute implements ResolverInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * ProductAttribute constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param Data $helperData
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        Data $helperData
    ) {
        $this->productRepository = $productRepository;
        $this->helperData        = $helperData;
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
    ): array {

        if (!$this->helperData->isEnabled()) {
            return [];
        }

        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        /** @var ProductInterface $product */
        $product = $this->productRepository->getById($value['model']->getId());

        return [
            'membership'             => $product->getData(FieldRenderer::MEMBERSHIP),
            'duration_type'          => $product->getData(FieldRenderer::DURATION),
            'membership_price_fixed' => $product->getData(FieldRenderer::PRICE),
            'duration_options'       => $product->getData(FieldRenderer::OPTIONS) ?: []
        ];
    }
}

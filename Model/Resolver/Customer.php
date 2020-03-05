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

namespace Mageplaza\MembershipGraphQl\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Mageplaza\Membership\Helper\Data;
use Mageplaza\Membership\Model\MembershipFactory;

/**
 * Class Customer
 * @package Mageplaza\MembershipGraphQl\Model\Resolver
 */
class Customer implements ResolverInterface
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var MembershipFactory
     */
    protected $membershipFactory;

    /**
     * Customer constructor.
     *
     * @param Data $helperData
     * @param MembershipFactory $membershipFactory
     */
    public function __construct(
        Data $helperData,
        MembershipFactory $membershipFactory
    ) {
        $this->helperData        = $helperData;
        $this->membershipFactory = $membershipFactory;
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

        $customer         = $value['model'];
        $data['customer'] = $customer;
        $membership       = $this->membershipFactory->create()->getCurrentMembership($customer->getId());

        /**
         * Reset value to format value
         */
        $membership->setName($membership->getName());
        $membership->setBenefit($membership->getBenefit());

        $data['current_membership'] = $membership;

        return $data;
    }
}

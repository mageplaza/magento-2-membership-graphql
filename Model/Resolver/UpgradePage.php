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

use Magento\Customer\Model\Customer;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Class MembershipPage
 * @package Mageplaza\MembershipGraphQl\Model\Resolver
 */
class UpgradePage extends MembershipPage
{
    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if ($this->helperData->versionCompare('2.3.3') &&
            $context->getExtensionAttributes()->getIsCustomer() === false) {
            throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
        }

        /** @var Customer $customer */
        /** @var \Magento\GraphQl\Model\Query\ContextInterface $context
         * \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context class is available < 2.3.3
         */
        $customer         = $this->getCustomer->execute($context);
        $this->customerId = $customer->getId();

        return parent::resolve($field, $context, $info, $value, $args);
    }
}

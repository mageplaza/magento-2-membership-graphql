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

namespace Mageplaza\MembershipGraphQl\Model;

use Magento\Framework\GraphQl\Query\Resolver\TypeResolverInterface;
use Mageplaza\Membership\Model\Product\Type\Membership;

/**
 * Class MembershipProductTypeResolver
 * @package Mageplaza\MembershipGraphQl\Model
 */
class MembershipProductTypeResolver implements TypeResolverInterface
{
    const TYPE = 'MembershipProduct';

    /**
     * @inheritdoc
     */
    public function resolveType(array $data): string
    {
        if (isset($data['type_id']) && $data['type_id'] === Membership::TYPE_MEMBERSHIP) {
            return self::TYPE;
        }

        return '';
    }
}

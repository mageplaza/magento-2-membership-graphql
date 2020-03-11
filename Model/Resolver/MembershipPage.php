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

use Magento\CustomerGraphQl\Model\Customer\GetCustomer;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\Membership\Helper\Data;
use Mageplaza\Membership\Model\MembershipRepository;

/**
 * Class MembershipPage
 * @package Mageplaza\MembershipGraphQl\Model\Resolver
 */
class MembershipPage extends AbstractMembership implements ResolverInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var MembershipRepository
     */
    protected $membershipRepository;

    /**
     * @var GetCustomer
     */
    protected $getCustomer;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var int
     */
    protected $customerId = 0;

    /**
     * MembershipPage constructor.
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param MembershipRepository $membershipRepository
     * @param GetCustomer $getCustomer
     * @param Data $helperData
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        MembershipRepository $membershipRepository,
        GetCustomer $getCustomer,
        Data $helperData
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->membershipRepository  = $membershipRepository;
        $this->getCustomer           = $getCustomer;
        $this->helperData            = $helperData;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helperData->isEnabled()) {
            throw new GraphQlNoSuchEntityException(__('Reward points is disabled.'));
        }

        $this->validate($args);
        $searchCriteria = $this->searchCriteriaBuilder->build('mp_membership_page', $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);
        if ($this->customerId) {
            $searchResult = $this->membershipRepository->getUpgradePage($this->customerId, $searchCriteria);
        } else {
            $searchResult = $this->membershipRepository->getMembershipPage($searchCriteria);
        }

        return $this->getResult($searchResult, $args);
    }
}

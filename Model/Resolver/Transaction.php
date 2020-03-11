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

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\Membership\Helper\Data;
use Mageplaza\Membership\Model\HistoryRepository;

/**
 * Class Transaction
 * @package Mageplaza\MembershipGraphQl\Model\Resolver
 */
class Transaction extends AbstractMembership implements ResolverInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var HistoryRepository
     */
    protected $historyRepository;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * Transaction constructor.
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param HistoryRepository $historyRepository
     * @param Data $helperData
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        HistoryRepository $historyRepository,
        Data $helperData
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->historyRepository     = $historyRepository;
        $this->helperData = $helperData;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helperData->isEnabled()) {
            return [];
        }

        $customer = $value['customer'];
        $this->validate($args);
        $searchCriteria = $this->searchCriteriaBuilder->build('mp_membership_transactions', $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);
        $searchResult = $this->historyRepository->getListByCustomerId($customer->getId(), $searchCriteria);

        return $this->getResult($searchResult, $args);
    }
}

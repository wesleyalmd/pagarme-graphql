<?php

declare(strict_types=1);

namespace SuperFrete\PagarmeGraphql\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use SuperFrete\PagarmeGraphql\Model\OrdersReport;
use Magento\Framework\Exception\LocalizedException;

class GetOrdersReport implements ResolverInterface
{
    protected $ordersReportModel;

    public function __construct(
        OrdersReport $ordersReportModel
    ) {
        $this->ordersReportModel = $ordersReportModel;
    }

    /**
     * Resolve the GraphQL query for getting orders report.
     *
     * @param Field $field
     * @param \Magento\GraphQl\Model\Query\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws LocalizedException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$context->getUserId()) {
            throw new LocalizedException(__('User is not logged in'));
        }

        $startDate = $args['start_date'];
        $endDate = $args['end_date'];

        return $this->ordersReportModel->getOrdersReport($startDate, $endDate);
    }
}

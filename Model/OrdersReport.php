<?php
namespace SuperFrete\PagarmeGraphql\Model;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;

class OrdersReport
{
    protected $orderCollectionFactory;

    public function __construct(
        CollectionFactory $orderCollectionFactory
    ) {
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function getOrdersReport($startDate, $endDate)
    {
        try {
         
            $orders = $this->orderCollectionFactory->create()
                ->addFieldToFilter('created_at', ['from' => $startDate, 'to' => $endDate])
                ->addFieldToSelect('grand_total');

            $totalSales = 0;
            $orderCount = 0;

            foreach ($orders as $order) {
                $totalSales += (float) $order->getGrandTotal();
                $orderCount++;
            }

            $averageTicket = $orderCount > 0 ? $totalSales / $orderCount : 0;

            return [
                'total_sales' => $totalSales,
                'average_ticket' => $averageTicket
            ];

        } catch (\Exception $e) {
            throw new LocalizedException(__('Error on get orders report: %1', $e->getMessage()));
        }
    }
}

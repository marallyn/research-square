<?php

/**
 * Class for searching orders
 */

class Orders
{
    /**
     * The orders array
     *
     * @var array
     */
    private $_orders;

    public function __construct(array $orders) {
        $this->_orders = $orders;
    }

    /**
     * Searches through all the orders to find the id of the customer with the most orders
     *
     * @return string
     */
    public function customerWithMostOrders() : string
    {
        $customerArr = $this->ordersByCustomer();

        $bestCustomerId = '';
        $mostOrders = 0;

        foreach ($customerArr as $customerId => $numOrders) {
            if ($numOrders > $mostOrders) {
                $mostOrders = $numOrders;
                $bestCustomerId = $customerId;
            }
        }

        return $bestCustomerId;
    }

    /**
     * Searches through all the orders to find the order with the highest total_price
     *
     * @return int
     */
    public function highestPrice() : int
    {
        return array_reduce($this->_orders, function($highestPrice, $order) {
            return $order['total_price'] > $highestPrice
                ? $order['total_price']
                : $highestPrice;
        }, PHP_INT_MIN);
    }

    /**
     * Searches through all the orders and creates an array of [customerId => numberOfOrders]
     *
     * @return array
     */
    private function ordersByCustomer() : array
    {
        return array_reduce($this->_orders, function($customerArr, $order) {
            $customerId = $order['customer_id'];

            if (isset($customerArr[$customerId])) {
                $customerArr[$customerId]++;
            } else {
                $customerArr[$customerId] = 1;
            }

            return $customerArr;
        }, []);
    }

    /**
     * Searches through all of the orders to find the total sales for the given year
     *
     * @param int $year
     * @return int
     */
    public function salesInYear(int $year) : int
    {
        return array_reduce($this->_orders, function ($sales, $order) use ($year) {
            $saleYear = intval((new \DateTime($order['created_date']))->format('Y'));

            return $saleYear === $year
                ? $sales + $order['total_price']
                : $sales;
        }, 0);
    }
}

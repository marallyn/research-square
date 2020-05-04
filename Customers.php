<?php

/**
 * Class for searching customers
 */

class Customers
{
    /**
     * The array of customers
     *
     * @var array
     */
    private $_customers;

    public function __construct(array $customers)
    {
        $this->_customers = $customers;
    }

    /**
     * Finds the customer record with the matching customerId
     *
     * @param string $customerId
     * @return void
     */
    public function getById(string $customerId) : array
    {
        foreach ($this->_customers as $customer) {
            if ($customer['id'] === $customerId) {
                break;
            }
        }

        return $customer;
    }
}

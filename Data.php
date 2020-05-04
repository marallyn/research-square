<?php

/**
 * Class for accessing the data file
 */

class Data
{
    /**
     * The raw data returned from the _dataUrl
     *
     * @var array
     */
    private $_data;

    /**
     * The url from which to access the data
     *
     * @var string
     */
    private $_dataUrl;

    public function __construct(string $dataUrl) {
        $this->_dataUrl = $dataUrl;

        $this->fetchData();
    }

    /**
     * Reaches out to _dataUrl to fetch some useful data
     *
     * @return void
     */
    private function fetchData()
    {
        $this->_data = json_decode(file_get_contents($this->_dataUrl), true);
    }

    /**
     * Returns the customers from the _data
     *
     * @return array
     */
    public function customers() : array
    {
        return $this->_data['customers'];
    }

    /**
     * Returns the orders from the _data
     *
     * @return array
     */
    public function orders() : array
    {
        return $this->_data['orders'];
    }
}

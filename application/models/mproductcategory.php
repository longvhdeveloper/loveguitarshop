<?php
class Mproductcategory extends Mbase
{
    private $tableName = 'productcategory';

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 2;

    public function __construct()
    {
        parent::__construct();
    }


    public function getStatusList()
    {
        $output = array();

        $output[self::STATUS_ENABLE] = 'Enable';
        $output[self::STATUS_DISABLE] = 'Disable';

        return $output;
    }

    public function getStatusName($status)
    {
        $name = '';

        switch ($status) {
            case self::STATUS_ENABLE:
                $name = 'Enable';
                break;
            case self::STATUS_DISABLE:
                $name = 'Disable';
                break;
        }

        return $name;
    }
}
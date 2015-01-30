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

    public function addData($data)
    {
        $this->db->insert($this->tableName, $data);
        $id = $this->db->insert_id();

        if ($id > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateData($id, $data)
    {
        $this->db->where('pc_id', $id);
        $this->db->update($this->tableName, $data);

        return true;
    }

    public function deleteData($id)
    {
        $this->db->where('pc_id', $id);
        $this->db->delete($this->tableName);

        return true;
    }

    public function getProductcategory($id)
    {
        $this->db->where('pc_id', $id);
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getProductcategorys(
        $where = array(),
        $orderBy = '',
        $orderType = '',
        $record = 0,
        $start = 0,
        $countOnly = false
    ) {
        if ($countOnly) {
            return $this->countList($where);
        } else {
            return $this->getList($where, $orderBy, $orderType, $record, $start);
        }
    }

    public function countList($where)
    {
        if (!empty($where)) {
            foreach ($where as $colName => $value) {
                if ($value != '') {
                    $this->db->where($colName, $value);
                }
            }
        }

        $query = $this->db->get($this->tableName);

        return $query->num_rows();
    }

    public function getList($where = array(), $orderBy, $orderType, $record, $start)
    {
        if (!empty($where)){
            foreach ($where as $colName => $value) {
                if ($value != '') {
                    $this->db->where($colName, $value);
                }
            }
        }
        if ($orderBy != '' && $orderType != '') {
            switch ($orderBy) {
                case 'id' :
                    $this->db->order_by('productcategory.pc_id', $orderType);
                    break;
                default:
                    $this->db->order_by('productcategory.pc_id', $orderType);
                    break;
            }
        }

        if ($record > 0) {
            $this->db->limit($record, $start);
        }
        $query = $this->db->get($this->tableName);

        return $query->result_array();
    }

    public function getMaxDisplayOrder()
    {
        $this->db->select('Max(pc_displayorder) as displayorder');
        $result = $this->db->get($this->tableName)->row_array();

        return ((int)$result['displayorder'] + 1);
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
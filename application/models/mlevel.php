<?php
class Mlevel extends CI_Model
{
    private $tableName = 'level';
    public function __construct()
    {
        parent::__construct();
    }


    public function addData($data)
    {
        $this->db->insert($this->tableName, $data);

        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getLevel($id)
    {
        $this->db->where('lv_id', $id);
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $this->db->where('lv_id', $id);
        $this->db->delete($this->tableName);
    }

    public function updateData($data, $id)
    {
        $this->db->where('lv_id', $id);
        $this->db->update($this->tableName, $data);
    }

    public function getLevels(
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
                    $this->db->order_by('level.lv_id', $orderType);
                    break;
                default:
                    $this->db->order_by('level.lv_id', $orderType);
                    break;
            }
        }

        if ($record > 0) {
            $this->db->limit($record, $start);
        }
        $query = $this->db->get($this->tableName);

        return $query->result_array();
    }

    public function countList($where = array())
    {
        if (!empty($where)){
            foreach ($where as $colName => $value) {
                if ($value != '') {
                    $this->db->where($colName, $value);
                }
            }
        }
        $query = $this->db->get($this->tableName);
        return $query->num_rows();
    }
}
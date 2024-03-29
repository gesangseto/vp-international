<?php
class _Datatables extends CI_Model
{
    private function _get_datatables_query($BaseData)
    {
        $i = 0;
        $this->db->from($BaseData['table']);
        if (@$BaseData['select']) {
            $this->db->select(@$BaseData['select']);
        }
        if (@$BaseData['where']) {
            $this->db->where(@$BaseData['where']);
        }
        if (@$BaseData['join']) {
            $this->db->join($BaseData['join']['table'], $BaseData['join']['on']);
        }
        if (@$BaseData['left_join']) {
            $this->db->join($BaseData['left_join']['table'], $BaseData['left_join']['on'], 'left');
        }

        if (@$BaseData['rigth_join']) {
            $this->db->join($BaseData['rigth_join']['table'], $BaseData['rigth_join']['on'], 'rigth');
        }
        if (@$BaseData['group_by']) {
            $this->db->group_by($BaseData['group_by']);
        }

        foreach ($BaseData['column_search'] as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($BaseData['column_search']) - 1 == $i) { //last loop
                    $this->db->group_end(); //close bracket
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($BaseData['column_order'][$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables($BaseData)
    {
        $this->_get_datatables_query($BaseData);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($BaseData)
    {
        $this->_get_datatables_query($BaseData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all($BaseData)
    {

        $count = $this->db->query("SELECT COUNT(*) AS count FROM " . $BaseData['table']);
        $count = $count->result_array();
        return $count[0]['count'];
    }
}

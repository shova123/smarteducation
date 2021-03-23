<?php

class News_model extends CI_Model {

    function list_all($table,  $orderBy = NULL, $group_by = NULL) {

        $this->db->select("*");


       
        if ($orderBy)
            $this->db->order_by($orderBy);

        if ($group_by)
            $this->db->group_by($group_by);
        $query = $this->db->get($table);

        return $query->result();
    }

}

?>
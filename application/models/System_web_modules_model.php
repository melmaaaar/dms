<?php
class System_web_modules_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'system_web_modules';
    }

    public function get_all()
    {
        $query = $this->db->select('*')
            ->from($this->table)
            ->where('deleted_at', NULL)
            ->where('deleted_by', NULL)
            ->order_by(1, 'asc')
            ->get();

        return $query->result();
    }

    public function get_all_active()
    {
        $query = $this->db->select('*')
            ->from($this->table)
            ->where('deleted_at', NULL)
            ->where('deleted_by', NULL)
            ->where('is_active', 1)
            ->order_by('ctr', 'ASC')
            ->get();

        return $query->result();
    }

    public function get($id = null)
    {
        $query = $this->db->select('*')
            ->from($this->table)
            ->where('deleted_at', NULL)
            ->where('deleted_by', NULL)
            ->where('id', $id)
            ->get();

        return $query->result();
    }
    
    public function get_by_user_id($id=NULL){

    	$query = $this->db->select('*')
                ->from($this->table)
                ->where('deleted_at', NULL)
                ->where('deleted_by', NULL)
                ->where("user_id", $id)
                ->get(); 

        return $query->result();
    }

    public function insert($data=NULL)
    {
        $this->db->insert($this->table, $data);
        
        if(!$this->db->insert_id())
            return 0;

        return $this->db->insert_id();
    }

    public function update($data=NULL,$id=NULL)
    {
        $this->db->update($this->table, $data, array("id" => $id));

        if(!$this->db->affected_rows())
            return 0;

        return $id;
    }

    public function delete($data=NULL,$id=NULL)
    {
        $this->db->update($this->table, $data, array("id" => $id));

        if(!$this->db->affected_rows())
            return 0;

        return $id;
    }

    public function generate_ctr()
    {
        $query = $this->db->query("SELECT CASE WHEN MAX(ctr) IS NULL THEN 1 ELSE MAX(ctr) + 1 END AS ctr FROM $this->table")
                          ->row_array();
        return $query['ctr'];
    }

    
    

}

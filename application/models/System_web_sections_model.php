<?php
class System_web_sections_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'system_web_sections';
    }

    public function get_all()
    {
        $query = $this->db->select('a.*,b.name as module_name')
            ->from($this->table.' a')
            ->join('system_web_modules b','a.web_module_id = b.id', 'inner')
            ->where('a.deleted_at', NULL)
            ->where('a.deleted_by', NULL)
            ->where('b.deleted_at', NULL)
            ->where('b.deleted_by', NULL)
            ->order_by(1, 'asc')
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

    public function get_by_module_id($id=NULL){

    	$query = $this->db->select('*')
                ->from($this->table)
                ->where('deleted_at', NULL)
                ->where('deleted_by', NULL)
                ->where("web_module_id", $id)
                ->order_by("ctr","asc")
                ->get(); 

        return $query->result();
    }

    public function generate_ctr()
    {
        $query = $this->db->query("SELECT CASE WHEN MAX(ctr) IS NULL THEN 1 END AS ctr FROM $this->table")
            ->row_array();

        return $query['ctr'];
    }
    

}

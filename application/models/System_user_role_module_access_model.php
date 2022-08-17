<?php
class System_user_role_module_access_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'system_user_role_module_access';
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

    public function get_by_role_id($role_id=NULL){

    	$query = $this->db->select('*')
                ->from($this->table)
                ->where('deleted_at', NULL)
                ->where('deleted_by', NULL)
                ->where("role_id", $role_id)
                ->where("can_access", 1)
                ->get(); 

        $result = $query->result();
        $array = array();
        foreach($result as $key => $value)
        {
            array_push($array,$value->web_module_id);
        }
        return $array;
    }

    public function can_access($module_id=NULL,$role_id=NULL){

    	$query = $this->db->select('*')
            ->from($this->table)
            ->where('deleted_at', NULL)
            ->where('deleted_by', NULL)
            ->where('web_module_id', $module_id)
            ->where('role_id', $role_id)
            ->get();

        return $query->result();
    }

    

}

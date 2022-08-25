<?php
class System_departments_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'system_departments';
    }

    public function get_all()
    {
        $query = $this->db->select('a.*, b.name as document_type, c.name as tlp_code, d.name as document_status, DATE_FORMAT(a.document_date,"%d-%M-%y") as sdocument_date')
            ->from($this->table. ' a')
            ->join('system_reference_group_values b','a.rgv_document_type_id = b.id', 'left outer')
            ->join('system_reference_group_values c','a.rgv_document_tlp_code_id = c.id', 'left outer')
            ->join('system_reference_group_values d','a.rgv_document_status_id = d.id', 'left outer')
            ->where('a.deleted_at', NULL)
            ->where('a.deleted_by', NULL)
            ->where('b.deleted_at', NULL)
            ->where('b.deleted_by', NULL)
            ->where('c.deleted_at', NULL)
            ->where('c.deleted_by', NULL)
            ->where('d.deleted_at', NULL)
            ->where('d.deleted_by', NULL)
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

}

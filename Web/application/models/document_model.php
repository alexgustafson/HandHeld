<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 16.12.12
   * Time: 15:20
   * To change this template use File | Settings | File Templates.
   */
  class Document_model extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_all_documents()
    {
      $this->db->select('*');
      $this->db->from('document');
      $query = $this->db->get();
      $data = $query->result();
      return $data;
    }

    public function get_document_by_id($id = null)
    {
      $this->db->select("*")->from('document')->where('id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    public function set_document()
    {

      $id = $this->input->post('document_id');
      $name = $this->input->post('document_name');


      if($id) //update
      {

        $data = array('name' => $name);
        $this->db->where('id', $id);
        $this->db->update('documents', $data);

        return $this->get_document_by_id($id);

      }else //insert
      {
        $data = array('name' => $name);
        $this->db->insert('documents', $data);

        $id = $this->db->insert_id();
        return $this->get_document_by_id($id);

      }

      //maybe error if it gets here
      redirect('/documents');
    }
  }

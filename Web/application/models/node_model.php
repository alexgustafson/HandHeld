<?php
  class Node_model extends CI_Model
  {
    var $parent_id = '';
    var $child_id = '';
    var $priority = '';

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function getNodesForParent($id = 1)
    {

      $this->db->select('*');
      $this->db->from('node');
      $this->db->where('node.parent_id', $id);
      $this->db->order_by('node.priority');
      $q = $this->db->get();
      $result = $q->result_array();

      //$this->content_type = $result['content_type'];
      //$this->id = $result['id'];
      //$this->data = $result['data'];
      //$this->data = json_decode($result['data']);

      return $result;

    }

    public function insert_content()
    {
      $this->content_type = $_POST['content_title'];
      $this->data = $_POST['content_data'];
      $this->create_date = time();
      $this->db->insert('content', $this);
    }

    public function update_content()
    {
      $this->content_type = $_POST['content_title'];
      $this->data = $_POST['content_data'];
      $this->update_date = time();
      $this->db->update('content', $this, array('id' => $_POST['id']));
    }
  }
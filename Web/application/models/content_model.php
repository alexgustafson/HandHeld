<?php
  class Content_model extends CI_Model
  {
    var $id = '';
    var $content_type = '';
    var $create_date = '';
    var $update_date = '';
    var $data = '';

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function getContent($id = 1)
    {

      $this->db->select('*');
      $this->db->from('content');
      $this->db->where('content.id', $id);
      $q = $this->db->get();

      $result = $q->result_array();

      return $result['0'];

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
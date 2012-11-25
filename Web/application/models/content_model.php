<?php
  class Content_model extends CI_Model
  {

    var $content_type = '';
    var $create_date = '';
    var $update_date = '';
    var $data = '';

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }


    public function getContent($slug = FALSE)
    {
      $this->load->database();
      if ($slug == FALSE)
      {
        $this->db->select('*');
        $this->db->from('content');
        $this->db->join('node', 'content.id = node.parent_id');
        $this->db->where('content.id', "1");
        $q = $this->db->get();
        return $q->result_array();
      }

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
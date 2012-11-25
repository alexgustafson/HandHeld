<?php
class Content_model extends CI_Model
{

  public function __construct () {
    parent::__construct();
    $this->load->database();
  }


  public function getContent($slug = FALSE)
  {
    $this->load->database();
    if($slug == FALSE)
    {
      $query = $this->db->get('content');
      return $query->result_array();
    }

    $query = $this->db->get_where('CONTENT', array('slug' => $slug));
    return $query->row_array();
  }
}
<?php
class Content_model extends CI_Model
{
  public function __contruct()
  {
    this->load->database();
  }

  public function getContent($slug = FALSE)
  {
    if($slug == FALSE)
    {
      $query = $this->db->get('CONTENT');
      return $query->result_array();
    }

    $query = $this->db->get_where('CONTENT', array('slug' => $slug));
    return $query->row_array();
  }
}
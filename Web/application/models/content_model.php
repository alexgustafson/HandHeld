
<?php
class Content_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_content($slug = FALSE)
  {
    if ($slug === FALSE)
    {
      $query = $this->db->get('content');
      return $query->result_array();
    }

    $query = $this->db->get_where('content', array('slug' => $slug));
    return $query->row_array();
  }
}
<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 16.12.12
   * Time: 15:20
   * To change this template use File | Settings | File Templates.
   */
  class Article_model extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_all_articles()
    {
      $this->db->select('*');
      $this->db->from('article');
      $query = $this->db->get();
      $data = $query->result();
      return $data;
    }

    public function get_all_article_types()
    {
      $this->db->select('*');
      $this->db->from('article_type');
      $query = $this->db->get();
      $data = $query->result();
      return $data;
    }

    public function get_article_by_id($id = null)
    {
      $this->db->select('*');
      $this->db->from('article');
      $this->db->where('article.id', $id);
      $query = $this->db->get();
      return $query->result();
    }

    public function set_article()
    {

      $id = $this->input->post('article_id');
      $name = $this->input->post('article_name');
      $type = $this->input->post('article_type');
      $data = $this->input->post('article_data');
      $parent_id = $this->input->post('article_parent_id');


      if($id) //update
      {

        $data = array('name' => $name,
                      'type'=> $type,
                      'data'=> $data,
                      'update_date' => date('c'),
                      'parent_id' => $parent_id);
        $this->db->where('article.id', $id);
        $this->db->update('article', $data);

        return $this->get_article_by_id($id);

      }else //insert
      {
        $data = array('name' => $name,
                      'type'=> $type,
                      'data'=> $data,
                      'create_date' => date('c'),
                      'parent_id' => $parent_id);
        $this->db->insert('article', $data);

        $id = $this->db->insert_id();
        return $this->get_article_by_id($id);
      }

    }

    public function delete_article($id)
    {

      if($id != null) //delete
      {

        $this->db->where("article.id",$id);
        $this->db->delete('article');

      }
    }
  }

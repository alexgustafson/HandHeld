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
      $this->db->select('a.id, a.name, a.data, t.name type, t.id type_id, t.isComposite');
      $this->db->from('article a');
      $this->db->join('template t', 't.id = a.template_id');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }

    public function get_all_templates()
    {
      $this->db->select('*');
      $this->db->from('template');
      $query = $this->db->get();
      $data = $query->result();
      return $data;
    }

    public function get_article_by_id($id = null)
    {
      $this->db->select('a.id, a.name, a.data, t.name type, t.id type_id, t.isComposite');
      $this->db->from('article a');
      $this->db->join('template t', 't.id = a.template_id');
      $this->db->where('a.id', $id);
      $query = $this->db->get();
      return $query->result();
    }

    public function set_article()
    {

      $id = $this->input->post('template_id');
      $name = $this->input->post('article_name');
      $type = $this->input->post('article_type');
      $data = $this->input->post('article_data');
      $parent_id = $this->input->post('article_parent_id');


      if($id) //update
      {

        $data = array('name' => $name,
                      'template_id'=> $type,
                      'data'=> $data,
                      'update_date' => date('c'),
                      'parent_id' => $parent_id);
        $this->db->where('article.id', $id);
        $this->db->update('article', $data);

        return $this->get_article_by_id($id);

      }else //insert
      {
        $data = array('name' => $name,
                      'template_id'=> $type,
                      'data'=> $data,
                      'create_date' => date('c'),
                      'parent_id' => $parent_id);
        $this->db->insert('article', $data);

        $id = $this->db->insert_id();
        $articles = $this->get_article_by_id($id);
        return $articles[0];

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

    public function get_fields_for_article($article)
    {
      $this->db->select('f.name name, ft.id field_type_id, ft.name field_type_name');
      $this->db->from('f');
      $this->db->where('f.template_id',$article->template_id);
      $this->db->join('field_type ft', 'ft.id = f.field_type_id');
      $query = $this->db->get();
      return $query->result();
    }

  }

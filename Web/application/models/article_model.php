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
      $this->load->model('Template_model');
    }

    public function get_all_articles()
    {
      $this->db->select('a.id, a.name, a.data, t.name template_name, t.id template_id, t.isComposite');
      $this->db->from('article a');
      $this->db->join('template t', 't.id = a.template_id');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }

    public function get_article_by_id($id = null)
    {
      $this->db->select('a.id, a.name, a.data, t.name template_name, t.id template_id, t.isComposite');
      $this->db->from('article a');
      $this->db->join('template t', 't.id = a.template_id');
      $this->db->where('a.id', $id);
      $query = $this->db->get();
      return $query->result();
    }

    public function set_article()
    {

      $id = $this->input->post('article_id');
      $name = $this->input->post('article_name');
      $article_data = $this->encode_article_data($id, $this->input->post('data'));
      $template_id = $this->input->post('template_id');

      if($id) //update
      {

        $data = array('name' => $name,
                      'data'=> $article_data,
                      'update_date' => date('c'));
        $this->db->where('article.id', $id);
        $this->db->update('article', $data);

        return $this->get_article_by_id($id);

      }else //insert
      {
        $data = array('name' => $name,
                      'template_id'=> $template_id,
                      'create_date' => date('c'));
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

    public function encode_article_data($article_id, $data)
    {
      $article = $this->get_article_by_id($article_id);
      $article = $article[0];

      $fields = $this->Template_model->get_all_children_fields($article->template_id);

      foreach($fields as &$field)
      {
        $field->value = $data[$field->id];
      }

      $data = json_encode($fields);

      return $data;
    }



  }

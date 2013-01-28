<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexgustafson
 * Date: 1/27/13
 * Time: 10:07 PM
 * To change this template use File | Settings | File Templates.
 */

class Template_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function get_all_template()
  {
    $this->db->select('*');
    $this->db->from('template');
    $query = $this->db->get();
    $data = $query->result();
    $template = array();
    foreach($data as $item){
      $template = $item;
    }

    return $template;
  }


  public function get_template($id)
  {
    $this->db->select('*');
    $this->db->from('template t');
    $this->db->where('t.id', $id);
    $query = $this->db->get();
    $data = $query->result();
    $template = array();
    foreach($data as $item){
      $template = $item;
    }

    return $template;
  }

  public function get_all_fields()
  {
    $this->db->select('*');
    $this->db->from('fields f');
    $query = $this->db->get();
    $data = $query->result();

    return $data;
  }

  public function get_all_field_types()
  {
    $this->db->select('*');
    $this->db->from('field_type ft');
    $query = $this->db->get();
    $data = $query->result();

    return $data;
  }

  public function get_fields_for_template($id)
  {
    if(isset($id))
    {
      $this->db->select('f.name name, ft.id field_type_id, ft.name field_type_name');
      $this->db->from('fields f');
      $this->db->where('f.template_id',$id);
      $this->db->join('field_type ft', 'ft.id = f.field_type_id');
      $this->db->order_by('f.order_nr', 'asc');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }
  }

  public function get_child_templates($id)
  {
    if(isset($id))
    {
      
      $this->db->select('*');
      $this->db->from('templates t');
      $this->db->where('t.template_id',$id);
      $this->db->order_by('f.order_nr', 'asc');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }
  }

  public function set_fields()
  {

    $id = $this->input->post('id');
    $template_id = $this->input->post('template_id');
    $field_type_id = $this->input->post('field_type_id');
    $order = $this->input->post('order');
    $name = $this->input->post('name');

    if($id) //update
    {

      $data = array('name' => $name,
                    'template_id' => $template_id,
                    'field_type_id' => $field_type_id,
                    'order' => $order);
      $this->db->update('fields', $data);

      return $this->get_document_by_id($id);

    }else //insert
    {
      $data = array('name' => $name,
                    'template_id' => $template_id,
                    'field_type_id' => $field_type_id,
                    'order' => $order);

      $this->db->insert('fields', $data);
      $id = $this->db->insert_id();

      return $this->get_document_by_id($id);
    }
    //maybe error if it gets here
    redirect('/documents');
  }

  public function set_field_type()
  {

    $id = $this->input->post('id');
    $name = $this->input->post('name');

    if($id) //update
    {

      $data = array('name' => $name);
      $this->db->insert('field_type', $data);

      return $this->get_document_by_id($id);

    }else //insert
    {
      $data = array('name' => $name);
      $this->db->insert('field_type', $data);
      $id = $this->db->insert_id();

      return $this->get_document_by_id($id);
    }
    //maybe error if it gets here
    redirect('/documents');
  }

  public function get_all_children_fields($id)
  {
    $template = $this->get_template($id);
    $fields = array();

    if($template->isComposite == 0)
    {
      $child_templates = $this->get_child_templates($id);
      foreach($child_templates as $item)
      {
        $fields = array_merge($fields, $this->get_all_children_fields($id));
      }

    }else
    {
      $fields = array_merge($fields, $this->get_fields_for_template($id));
    }

    return $fields;
  }

}
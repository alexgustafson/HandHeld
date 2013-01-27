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

}
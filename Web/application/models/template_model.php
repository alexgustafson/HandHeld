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

  public function get_all_templates()
  {
    $this->db->select('*');
    $this->db->from('template');
    $query = $this->db->get();
    $data = $query->result();
    $templates = array();
    foreach($data as $item){
      $templates[$item->id] = $item;
    }

    return $templates;
  }


  public function get_template($id)
  {
    $this->db->select('*');
    $this->db->from('template t');
    $this->db->where('t.id', $id);
    $query = $this->db->get();
    $data = $query->result();
    $template = '';
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
      $this->db->select('f.id, f.name name, ft.id field_type_id, ft.name field_type_name, f.child_template_id');
      $this->db->from('fields f');
      $this->db->where('f.template_id',$id);
      $this->db->join('field_type ft', 'ft.id = f.field_type_id', 'left outer');
      $this->db->order_by('f.order_nr', 'asc');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }
  }

  public function get_field_by_id($id)
  {
    if(isset($id))
    {
      $this->db->select('f.id, f.name name, ft.id field_type_id, ft.name field_type_name, f.child_template_id');
      $this->db->from('fields f');
      $this->db->where('f.id',$id);
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

    if($template->isComposite == 1)
    {
      $children = $this->get_fields_for_template($id);
      foreach($children as $child)
      {
        if($child->child_template_id > 0 && $child->field_type_id == 0)
        {
          //child is a subtemplate
          $subtemplate =new stdClass();
          $subtemplate->name = $child->name;
          $subtemplate->field_type_name = 'subtemplate';
          $subtemplate->id = $child->id;
          $subtemplate->children = $this->get_all_children_fields($child->child_template_id) ;

          array_push($fields, $subtemplate );


        }else
        {
          //child is a normal field
          $fields = array_merge($fields, $this->get_field_by_id($child->id));
        }

      }

    }else
    {
      $fields = array_merge($fields, $this->get_fields_for_template($id));
    }

    return $fields;
  }

  public function addFieldToTemplate($name, $template_id, $field_type_id)
  {
    $order_nr = $this->countFieldAndTemplates($template_id);
    $data = array('name' => $name,
                  'template_id' => $template_id,
                  'field_type_id' => $field_type_id,
                  'order_nr' => $order_nr);

    $this->db->insert('fields', $data);
    $id = $this->db->insert_id();
  }


  public function addSubtemplateToTemplate($name, $parent_template, $child_template_id)
  {
    $order_nr = $this->countFieldAndTemplates($parent_template);
    $data = array('name' => $name,
                  'template_id' => $parent_template,
                  'child_template_id' => $child_template_id,
                  'order_nr' => $order_nr);

    $this->db->insert('fields', $data);
    $id = $this->db->insert_id();
  }


  public function countFieldAndTemplates($template_id)
  {
    $this->db->select('*');
    $this->db->from('fields f');
    $this->db->where('f.template_id', $template_id);
    $result = $this->db->get()->result();


    return count($result);
  }

  public function reorder_children()
  {
    $children = $this->input->post('fields');
    $i = 0;
    if($children != false){
      foreach ($children as $child)
      {
        $data = array('order_nr' => $i);
        $this->db->where('id', $child);
        $this->db->update('fields', $data);

        $i++;
      }
    }
  }

  public function update($template_id)
  {
    $template_name = $this->input->post('template_name');

    $data = array('name' => $template_name);
    $this->db->where('id', $template_id);
    $this->db->update('template', $data);

    $new_children = $this->input->post('fields');
    $old_children = $this->get_all_children_fields($template_id);

    if($new_children == false)
    {
      $this->db->where('template_id', $template_id);
      $this->db->delete('fields');
      return;
    }


    foreach ($old_children as $old_child)
    {
      $deleted = true;
      foreach ($new_children as $new_child_id)
      {
        if($old_child->id == $new_child_id)
        {
          $deleted = false;
        }
      }

      if($deleted)
      {
        $this->db->where('id', $old_child->id);
        $this->db->delete('fields');
      }

    }

  }

  public function delete($template_id)
  {
    $this->db->where('template_id', $template_id);
    $this->db->delete('fields');

    $this->db->where('child_template_id', $template_id);
    $this->db->delete('fields');

    $this->db->where('id', $template_id);
    $this->db->delete('template');
  }



}
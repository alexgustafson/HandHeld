<?php

class Contenttype_model extends CI_Model
{
  var $type;
  var $isComposite;
  var $fields;

  function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('Fieldtype_model');
  }

  public function getAll()
  {
    $query = $this->db->get('content_type');
    $data = $query->result();
    $result = array();
    foreach($data as $content_type)
    {
      $content_type['fields'] = $this->Fieldtype_model->getFieldsForContentType($content_type->id);
      $result[$content_type->id] = $content_type;

    }

    return $result;
  }

}
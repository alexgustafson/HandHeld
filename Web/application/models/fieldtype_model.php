<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 05.12.12
   * Time: 16:09
   * To change this template use File | Settings | File Templates.
   */
  class Fieldtype_model extends CI_Model
  {
    var $name;

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function getFieldsForContentType($content_type_id)
    {
      $this->db->select('*');
      $this->db->from('fields');
      $this->db->where('content_type_id', $content_type_id);
      $query = $this->db->get();
      $data = $query->resutl();
      return $data;
    }

  }

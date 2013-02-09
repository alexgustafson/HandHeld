<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 16.12.12
   * Time: 15:20
   * To change this template use File | Settings | File Templates.
   */
  class Assets_model extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_all_assets()
    {
      $this->db->select('*');
      $this->db->from('files f');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }

    public function get_all_images()
    {
      $this->db->select('*');
      $this->db->from('files f');
      $this->db->where('mime', 'image/jpeg');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }



  }

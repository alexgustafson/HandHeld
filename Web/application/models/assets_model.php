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

    var $deploy_folder;
    var $asset_folder;
    var $db_folder;

    function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->helper('path');
      $this->deploy_folder = './deploy/';
      $this->asset_folder = './uploads/';
      $this->db_folder = './application/db/';
    }

    public function get_deploy_folder_path()
    {

      return $this->deploy_folder;
    }

    public function get_asset_folder_path()
    {

      return $this->asset_folder;
    }

    public function get_db_folder_path()
    {

      return $this->db_folder;
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
      $this->db->where('mime', 'image/png');
      $this->db->or_where('mime', 'image/jpeg');
      $query = $this->db->get();
      $data = $query->result();

      return $data;
    }



  }

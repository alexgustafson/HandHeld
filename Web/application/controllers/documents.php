<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alex_gustafson
   * Date: 16.12.12
   * Time: 14:32
   * To change this template use File | Settings | File Templates.
   */

  class Documents extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();

    }

    public function index( $action = null )
    {

      $data['action'] = 'overview';

      $this->load->view('templates/header', $data);
      $this->load->view('templates/leftmenu', $data);
      $this->load->view('templates/contentheader', $data);
      $this->load->view('documents/index.php', $data);
      $this->load->view('templates/footer', $data);
    }
  }

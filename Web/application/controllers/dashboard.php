<?php
  /**
   * Created by JetBrains PhpStorm.
   * User: alexgustafson
   * Date: 11/25/12
   * Time: 3:05 PM
   * To change this template use File | Settings | File Templates.
   */

  class Dashboard extends CI_Controller {

    public function __construct()
    {
      parent::__construct();

    }

    public function index( $page='home' )
    {

      $data['title'] = ucfirst($page); // Capitalize the first letter

      $this->load->view('partials/header', $data);
      $this->load->view('partials/leftmenu', $data);
      $this->load->view('partials/contentheader', $data);
      $this->load->view('pages/'.$page, $data);
      $this->load->view('partials/footer', $data);
    }
  }